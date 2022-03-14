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
            $table->string("day")->default('');
            $table->string("date")->default('');
            $table->string("adult")->default('');
            $table->string("child")->default('');
            $table->string("toddler")->default('');
            $table->string("infant")->default('');
            $table->string("senior")->default('');
            $table->string("tax_percentage")->default('');
            $table->string("tax_amount")->default('');
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
