<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCruiseShipRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruise_ship_room_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->bigInteger("cruise_ship_id");
            $table->integer("default_guest");
            $table->integer("max_guest");
            $table->longText("images");
            $table->string("status")->default('0');
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
        Schema::dropIfExists('cruise_ship_room_types');
    }
}
