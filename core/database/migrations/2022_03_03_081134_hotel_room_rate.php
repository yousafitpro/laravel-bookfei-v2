<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HotelRoomRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_room_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("hotel_room_type_id");
            $table->string("day")->default(null);
            $table->string("date")->default(null);
            $table->string("adult")->default(null);
            $table->string("child")->default(null);
            $table->string("toddler")->default(null);
            $table->string("infant")->default(null);
            $table->string("senior")->default(null);
            $table->string("tax_percentage")->default(null);
            $table->string("tax_amount")->default(null);
            $table->string("is_disabled")->default('1');
            $table->softDeletes();
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
        Schema::dropIfExists('hotel_room_rates');
    }
}
