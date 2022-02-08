<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("tour_id");
            $table->string("day")->default('0');
            $table->string("adult")->default('0');
            $table->string("child")->default('0');
            $table->string("toddler")->default('0');
            $table->string("infant")->default('0');
            $table->string("senior")->default('0');
            $table->string("tax_percentage")->default('0');
            $table->string("tax_amount")->default('0');
            $table->string("is_disabled")->default('1');
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
        Schema::dropIfExists('tour_rates');
    }
}
