<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 		Schema::create('tblRating', function (Blueprint $table) {
			$table->integer('userRating');
			$table->integer('adID');
			$table->string('category', 70);
			$table->string('notes')->nullable();
			$table->integer('rating');
			$table->datetime('ratingDateTime');
			$table->foreign('adID')->references('id')->on('ads')->onDelete('cascade'); 
			$table->foreign('userRating')->references('id')->on('users')->onDelete('cascade');
			$table->primary(['userRating',  'adID']);
        });
	}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('tblRating');
    }
}
