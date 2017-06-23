<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('user_id')->unsigned()->index();           
            $table->String('description');
            $table->string('category', 50);
            $table->string('pickupAddress', 100);
			$table->string('pickupCity', 100);
            $table->string('pickupPostalCode', 7);
            $table->string('pickupProvince', 100);
            $table->string('dropoffAddress', 100);
			$table->string('dropoffCity', 100);
            $table->string('dropoffPostalCode', 7);
            $table->string('dropoffProvince', 100);
            $table->boolean('cancelled')->default(false);
			$table->boolean('shopper')->default(false);
			$table->boolean('complete')->default(false);
            $table->datetime('datetimeDelivery');
            $table->timestamps();
			$table->decimal('price', 9, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('ads');
    }
}
