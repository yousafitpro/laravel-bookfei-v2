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
            $table->integer('phone');
            $table->integer('email');
            $table->string('age_group');
            $table->longText('images');
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
