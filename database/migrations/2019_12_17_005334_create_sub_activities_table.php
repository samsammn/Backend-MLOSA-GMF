<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
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
        Schema::dropIfExists('sub_activities');
    }
}
