<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAcceptedJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblJobDriverAccept', function (Blueprint $table) {
			$table->integer('adID');
			$table->integer('userWantsJob'); 
			$table->boolean('accepted')->default(true);
			$table->boolean('cancelled')->default(false);
			$table->boolean('completed')->default(false);
			$table->text('noteClient')->nullable();
			$table->text('noteDriver')->nullable();
			$table->datetime('offeredDateTime');
			$table->datetime('decisionDateTime')->nullable();
 			$table->foreign('adID')->references('id')->on('ads')->onDelete('cascade'); 
			$table->foreign('userWantsJob')->references('id')->on('users')->onDelete('cascade'); 
			$table->primary(['adID', 'userWantsJob']);
       	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblJobDriverAccept');
    }
}
