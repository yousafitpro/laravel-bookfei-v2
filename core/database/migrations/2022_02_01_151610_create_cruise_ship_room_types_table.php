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
            $table->string('name')->default('');
            $table->string('code')->default('');
            $table->bigInteger('cruise_ship_id')->nullable();
            $table->bigInteger('cruise_ship_rate_table_id')->nullable();
            $table->string('default_guest')->default('0');
            $table->string('max_guest')->default('0');
            $table->longText('images')->nullable();
//
//            $table->string("adult_age_start")->nullable();
//            $table->string("adult_age_end")->nullable();
//            $table->string("is_adult")->default('1');
//            $table->string("child_age_start")->nullable();
//            $table->string("child_age_end")->nullable();
//            $table->string("is_child")->default('1');
//
//            $table->string("toddler_age_start")->nullable();
//            $table->string("toddler_age_end")->nullable();
//            $table->string("is_toddler")->default('1');
//
//            $table->string("infant_age_start")->nullable();
//            $table->string("infant_age_end")->nullable();
//            $table->string("is_infant")->default('1');
//
//            $table->string("senior_age_start")->nullable();
//            $table->string("senior_age_end")->nullable();
//            $table->string("is_senior")->default('1');

            $table->string("status")->default('1');
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
