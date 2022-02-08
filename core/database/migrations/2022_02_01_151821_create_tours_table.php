<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->bigInteger("currency_id");
            $table->bigInteger("supplier_id");
            $table->date("effective_start_date");
            $table->date("effective_end_date");
            $table->boolean("early_bird")->default(false);
            $table->integer("early_bird_before_departure_date")->default(0);

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
        Schema::dropIfExists('tours');
    }
}
