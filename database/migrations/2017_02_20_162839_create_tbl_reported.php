<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblReported extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblReportFiled', function (Blueprint $table) {
 			$table->increments('id');
			$table->integer('userReported')->index();
			$table->integer('userReportedBy')->index();
			$table->string('category', 70);
			$table->string('notes')->nullable();
			$table->datetime('dateCreated'); 
			$table->foreign('userReported')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('userReportedBy')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblReportFiled');
    }
}
