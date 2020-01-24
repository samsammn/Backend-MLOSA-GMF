<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Model\UIC;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = User::with('uic')->uicId($request->uic_id)->search($request->search)->get();
        return new ResultCollection($model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'uic_id' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        $model = User::create($request->all());
        return new Result($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = User::with('uic')->find($id);
        return new Result($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $model = User::find($id);
        $result = new Result($model);

        if ($model != null)
        {
            $model->update($request->all());
            $result->additional(['message' => 'update successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to update, user not found!']);
            return $result;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::find($id);
        $result = new Result($model);

        if ($model != null)
        {
            $model->delete();
            $result->additional(['message' => 'delete successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to delete, user not found!']);
            return $result;
        }
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        if ($request->remember_me)
        {
            Config::set('sessions.lifetime', 35791394);
        } else {
            Config::set('sessions.lifetime', 120);
        }

        $isValidSignin = $this->checkLdap($username, $password);

        if ($isValidSignin)
        {

            $client = new Client();
            $headers = [
                'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4',
                'username' => $username,
            ];

            $response = $client->get('http://172.16.40.164/API/Observer', [
                'headers' => $headers
            ]);

            $body = json_decode($response->getBody(), true);

            if ($body == [])
            {
                $data = [];
                $isValidSignin = false;
            } else {
                $data_soe = $body[0];

                $uic = UIC::where('uic_code', '=', substr($data_soe['uic'], 3, 2))->first();

                $data = [
                    'username' => $data_soe['username'],
                    'fullname' => $data_soe['fullname'],
                    'position' => $data_soe['jabatan'],
                    'obslicense' => $data_soe['obslicense'],
                    'photo' => $data_soe['photo'],
                    'uic_id' => $uic->id,
                    'uic' => $uic->uic_code,
                    'sub_uic' => $data_soe['uic'],
                    'role' => $data_soe['obslicense'] != "" ? "Engineer Observer" : "UIC",
                    'status' => 1
                ];

                $dataUser = Arr::except($data, ['sub_uic', 'uic']);

                $isExists = User::where('username', '=', $username)->first();

                if (!$isExists){
                    // simpan data dari soe ke internal db
                    User::create($dataUser);
                } else {
                    // dilakukan pengubahan apabila ada update data dari soe
                    $isExists->update($dataUser);
                }

                $data['id'] = $isExists->id;

                $request->session()->put('username', $username);
            }

        } else {
            $data = [];
        }

        return response()->json([
            'data' => $data,
            'result' => $isValidSignin
        ]);
    }

    function signout(Request $request)
    {
        $request->session()->forget('username');
        return response()->json([
            'message' => 'Successfully Logout'
        ]);
    }

    function check_auth(Request $request)
    {
        $hasLogin = $request->session()->has('username');
        return response()->json([
            'hasLogin' => $hasLogin
        ]);
    }

    function checkLdap($username, $password)
    {

        $dn = "DC=gmf-aeroasia,DC=co,DC=id";
        // $ldapconn = ldap_connect("192.168.240.57") or die ("Could not connect to LDAP server.");
        $ip_ldap = [
            '0' => "192.168.240.66",
            '1' => "192.168.240.57",
            '2' => "172.16.100.46",
        ];

        $ipcon="";
        for($a=0;$a<count($ip_ldap);$a++){
            $ldapconn = ldap_connect($ip_ldap[$a]);
            if($ldapconn){
                $ipcon=$ip_ldap[$a];
                break;
            }else{
                // log_message("error", "IP : ".$ip_ldap[$a]."- Not Connected");
                continue;
            }
        }

        if ($ldapconn) {
            ldap_set_option(@$ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option(@$ldapconn, LDAP_OPT_REFERRALS, 0);
            $ldapbind = ldap_bind($ldapconn, "ldap", "aeroasia");
            @$sr = ldap_search($ldapconn, $dn, "samaccountname=$username");
            @$srmail = ldap_search($ldapconn, $dn, "mail=$username@gmf-aeroasia.co.id");
            @$info = ldap_get_entries($ldapconn, @$sr);
            @$infomail = ldap_get_entries($ldapconn, @$srmail);
            @$usermail = substr(@$infomail[0]["mail"][0], 0, strpos(@$infomail[0]["mail"][0], '@'));
            @$bind = @ldap_bind($ldapconn, $info[0]['dn'], $password);
            if(!$bind){
            return false;
            // log_message("error", "IP : ".$ipcon."- Eror Bind");
            }
            if ((@$info[0]["samaccountname"][0] == $username AND ($bind || isset($bind))) OR (@$usermail == $username AND ($bind || isset($bind)))) {
                //return mb_convert_encoding($info, 'UTF-8', 'UTF-8');
                return true;
            } else {

                return false;
            }
        } else {
            echo "LDAP Connection trouble, please try again 2/3 time";
        }
    }
}
