<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_hotels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('rate_table_id');
            $table->string('total_num_of_hotels')->nullable();
            $table->string('hotel_group')->nullable();
            $table->string('nights')->nullable();
            $table->string('min_nights')->nullable();
            $table->string('max_nights')->nullable();
            $table->string('is_compulsory')->nullable()->default('false');
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
        Schema::dropIfExists('offer_hotels');
    }
}
