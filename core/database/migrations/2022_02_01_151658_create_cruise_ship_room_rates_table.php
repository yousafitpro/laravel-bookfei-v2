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
            $table->bigInteger("cruise_ship_room_type_id");
            $table->string("day")->nullable()->default(null);
            $table->string("date")->nullable()->default(null);
            $table->string("adult")->nullable()->default(null);
            $table->string("child")->nullable()->default(null);
            $table->string("toddler")->nullable()->default(null);
            $table->string("infant")->nullable()->default(null);
            $table->string("senior")->nullable()->default(null);
            $table->string("tax_percentage")->nullable()->default('');
            $table->string("tax_amount")->nullable()->default('');
            $table->string("room_price")->nullable()->default('');
            $table->string("is_disabled")->nullable()->default('1');
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
