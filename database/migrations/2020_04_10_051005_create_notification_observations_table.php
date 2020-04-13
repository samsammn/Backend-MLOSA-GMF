<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_observations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('observation_id');
            $table->integer('admin')->default('0');
            $table->integer('uic')->default('0');
            $table->string('unit', 5)->nullable();
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
        Schema::dropIfExists('notification_observations');
    }
}
