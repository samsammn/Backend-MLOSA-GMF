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
            $table->integer('activity_id');
            $table->integer('sub_activity_id');
            $table->string('safety_risk', 5);
            $table->integer('sub_threat_codes_id');
            $table->string('risk_index', 3);
            $table->integer('severity');
            $table->integer('probability');
            $table->integer('control_effectiveness');
            $table->integer('risk_value');
            $table->integer('control_efectivenes');
            $table->string('effectively_managed', 5);
            $table->integer('error_outcome');
            $table->text('remark');
            $table->string('risk_index_actual', 3);
            $table->string('risk_index_proposed', 3);
            $table->string('revised_risk_index', 3);
            $table->integer('revised_severity');
            $table->integer('revised_probability');
            $table->integer('revised_control_effectiveness');
            $table->integer('propose_risk_value');
            $table->string('accept_or_treat', 10);
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
