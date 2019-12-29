<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_indices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value', 5);
            $table->integer('probability_id');
            $table->integer('severity_id');
            $table->integer('risk_value_id');
            $table->integer('risk_control_id');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_indices');
    }
}
