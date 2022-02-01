<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->bigInteger('hotel_id');
            $table->string('default_guest')->default('0');
            $table->string('max_guest')->default('0');
            $table->string('max_extra_bed')->default('0');
            $table->longText('images')->nullable();
            $table->string('status')->default('');
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
        Schema::dropIfExists('hotel_room_types');
    }
}
