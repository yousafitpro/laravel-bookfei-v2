<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCruiseShipRoomRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruise_ship_room_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("cruise_ship_rate_table_id");
            $table->bigInteger("cruise_ship_room_type_id");
            $table->string("year");
            $table->string("month");
            $table->longText("date_data");
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
        Schema::dropIfExists('cruise_ship_room_rates');
    }
}
