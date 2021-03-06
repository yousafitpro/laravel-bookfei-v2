<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rate_tables', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->bigInteger("hotel_id");
            $table->bigInteger("currency_id");
            $table->bigInteger("supplier_id");
            $table->date("effective_start_date");
            $table->date("effective_end_date")->nullable();
            $table->boolean("early_bird")->nullable()->default(false);
            $table->boolean("bonus_night")->nullable()->default(false);
            $table->string("bonus_night_type")->nullable();
            $table->string("min_nights")->nullable()->default(1);
            $table->string("max_nights")->nullable()->default(1);
            $table->string("x_nights")->nullable()->default(1);
            $table->string("y_nights")->nullable()->default(1);
            $table->integer("early_bird_before_departure_date")->nullable()->default(0);



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
        Schema::dropIfExists('hotel_rate_tables');
    }
}
