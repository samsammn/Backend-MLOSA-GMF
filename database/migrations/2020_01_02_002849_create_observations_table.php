<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observation_no', 50);
            $table->date('observation_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('subtitle');
            $table->date('due_date');
            $table->integer('mp_id');
            $table->integer('uic_id');
            $table->string('component_type', 50);
            $table->string('observer_team', 50);
            $table->string('task_observed', 50);
            $table->text('location');
            $table->string('status', 20);
            $table->string('action', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observations');
    }
}
