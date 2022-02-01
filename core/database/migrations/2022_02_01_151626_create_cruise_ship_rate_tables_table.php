<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCruiseShipRateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruise_ship_rate_tables', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->bigInteger("hotel_id");
            $table->bigInteger("currency_id");
            $table->bigInteger("supplier_id");
            $table->timestamp("effective_start_date");
            $table->timestamp("effective_end_date");
            $table->integer("nights");
            $table->integer("early_bird");
            $table->string("bonus_nights");
            $table->string("fre_guest");
            $table->integer("early_bird_before_check_in_date");
            $table->integer("buy_x_nights");
            $table->integer("get_y_free_nights");
            $table->string("free_guest_rule");
            $table->string("status");
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
        Schema::dropIfExists('cruise_ship_rate_tables');
    }
}
