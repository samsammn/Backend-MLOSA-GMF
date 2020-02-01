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
            $table->string('observation_no', 50)->nullable();
            $table->date('observation_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('subtitle')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('mp_id')->nullable();
            $table->integer('uic_id')->nullable();
            $table->string('component_type', 50)->nullable();
            $table->string('task_observed', 50)->nullable();
            $table->text('location')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('action', 30)->nullable();
            $table->text('comment')->nullable();
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
