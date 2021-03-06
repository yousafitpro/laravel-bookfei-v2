<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_flights', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id');
            $table->string('flight_route_type');
            $table->bigInteger('arrival_airport');
            $table->bigInteger('departure_airport');
            $table->longText('airline')->nullable();
            $table->string('class');
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
        Schema::dropIfExists('offer_flights');
    }
}
