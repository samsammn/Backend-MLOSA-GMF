<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskAcceptabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_acceptabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tolerability', 30)->nullable();
            $table->text('risk_index')->nullable();
            $table->string('color', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_acceptabilities');
    }
}
