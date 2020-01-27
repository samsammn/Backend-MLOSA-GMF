<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prepared_by');
            $table->string('checked_by');
            $table->string('approved_by');
            $table->string('status');
            $table->text('title');
            $table->text('subject');
            $table->string('report_no');
            $table->date('date');
            $table->string('attention');
            $table->string('issued');
            $table->string('distribution');
            $table->text('introduction');
            $table->text('brief_summary');
            $table->text('regression_analysis');
            $table->text('threat_error');
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
        Schema::dropIfExists('report');
    }
}
