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
            $table->string('name')->default('');
            $table->string('code')->default('');
            $table->bigInteger('hotel_id')->default('');
            $table->bigInteger('currency_id')->default('');
            $table->bigInteger('supplier_id')->default('');
            $table->timestamp('effective_start_date')->default('');
            $table->timestamp('effective_end_date')->default('');
            $table->string('early_bird')->default('0');
            $table->string('bonus_nights')->default('0');
            $table->integer('early_bird_before_check_in_date')->default(0);
            $table->integer('buy_x_nights')->default(0);
            $table->integer('get_y_free_nights')->default(0);
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
        Schema::dropIfExists('hotel_rate_tables');
    }
}
