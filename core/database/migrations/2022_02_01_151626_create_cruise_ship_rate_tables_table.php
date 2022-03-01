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
            $table->bigInteger("cruise_ship_id");
            $table->bigInteger("currency_id");
            $table->bigInteger("supplier_id");
            $table->date("effective_start_date");
            $table->date("effective_end_date");
            $table->boolean("early_bird")->default(false);
            $table->boolean("bonus_night")->default(false);
            $table->string("nights");
            $table->string("rule");
            $table->string("min_nights")->default(1);
            $table->string("max_nights")->default(1);
            $table->string("x_nights")->default(1);
            $table->string("y_nights")->default(1);
            $table->integer("early_bird_before_departure_date")->default(0);
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
        Schema::dropIfExists('cruise_ship_rate_tables');
    }
}
