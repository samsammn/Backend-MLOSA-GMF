<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('observation_id');
            $table->bigInteger('mp_detail_id');
            $table->integer('safety_risk_id');
            $table->integer('threat_code_id');
            $table->integer('risk_index_id');
            $table->integer('control_efectivenes');
            $table->string('effectively_managed', 5);
            $table->string('error_outcome', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observation_details');
    }
}
