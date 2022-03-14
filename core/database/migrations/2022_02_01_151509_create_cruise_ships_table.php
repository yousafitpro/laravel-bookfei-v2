<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCruiseShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruise_ships', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("english_name")->nullable();
            $table->bigInteger('cruise_line_id');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->longText('images')->nullable();

            $table->string("adult_age_start")->nullable();
            $table->string("adult_age_end")->nullable();
            $table->string("is_adult")->default('1');

            $table->string("child_age_start")->nullable();
            $table->string("child_age_end")->nullable();
            $table->string("is_child")->default('1');

            $table->string("toddler_age_start")->nullable();
            $table->string("toddler_age_end")->nullable();
            $table->string("is_toddler")->default('1');

            $table->string("infant_age_start")->nullable();
            $table->string("infant_age_end")->nullable();
            $table->string("is_infant")->default('1');

            $table->string("senior_age_start")->nullable();
            $table->string("senior_age_end")->nullable();
            $table->string("is_senior")->default('1');


            $table->string('status')->default('0');
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
        Schema::dropIfExists('cruise_ships');
    }
}
