<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMlosaPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mlosa_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('subtitle');
            $table->date('due_date');
            $table->bigInteger('mp_id');
            $table->integer('uic_id');
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
        Schema::dropIfExists('mlosa_plans');
    }
}
