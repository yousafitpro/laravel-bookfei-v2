<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('default_markup_type')->default("Percentage");
            $table->string('default_markup_percentage')->default('0');
            $table->string('default_markup_amount')->default('0');
            $table->string('levy')->default('0');
            $table->timestamps();
        });


//        Schema::table('countries', function($table) {
//
//            $table->bigInteger("area_id");
//            $table->string("name");
//            $table->string("english_name");
//            $table->longText("image");
//            $table->string("status")->default('1');
//            $table->softDeletes();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');

    }
}
