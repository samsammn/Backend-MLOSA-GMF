<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('uic')->paginate();
        return new ResultCollection($user);
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

        $user = User::create($request->all());
        return new Result($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('uic')->find($id);
        return new Result($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $user->update($request->all());
        return new Result($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $result = new Result($user);

        if ($user != null)
        {
            $user->delete();
            $result->additional(['message' => 'deleted successfully']);
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

        $isValidSignin = $this->checkLdap($username, $password);
        return response()->json(['result' => $isValidSignin ]);
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
