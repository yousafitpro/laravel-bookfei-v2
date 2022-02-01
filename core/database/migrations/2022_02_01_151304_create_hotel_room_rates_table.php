<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomRatesTable extends Migration
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
            $table->bigInteger('hotel_rate_table_id');
            $table->bigInteger('hotel_room_type_id');
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->longText('date_data')->nullable();
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
