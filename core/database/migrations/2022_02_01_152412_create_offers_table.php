<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('travel_product_id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->string('mini_guest')->nullable();
            $table->string('max_guest')->nullable();
            $table->string('effective_date_start')->nullable();
            $table->string('effective_date_end')->nullable();
            $table->string('departure_date_start')->nullable();
            $table->string('departure_date_end')->nullable();
            $table->string('booking_date_start')->nullable();
            $table->string('booking_date_end')->nullable();
            $table->string('markup_type')->nullable();
            $table->string('markup_percentage')->nullable();
            $table->string('markup_amount')->nullable();
            $table->string('agent_commission')->nullable();
            $table->string('commission_percentage')->nullable();
            $table->string('commission_amount')->nullable();
            $table->longText('tag')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
