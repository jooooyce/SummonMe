<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblReportResolution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('tblReportResolution', function (Blueprint $table) {
            	$table->integer('reportID');
	    		$table->integer('admin_username'); 
            	$table->datetime('dateDecisionMade');
	    		$table->string('decision');
				$table->string('notes'); 
				$table->primary(['admin_username', 'reportID', 'dateDecisionMade']);
				$table->foreign('reportID')->references('id')->on('tblReportFiled')->onDelete('cascade');
				$table->foreign('admin_username')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblReportResolution');
    }
}
