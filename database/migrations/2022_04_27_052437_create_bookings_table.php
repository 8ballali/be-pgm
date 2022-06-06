<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->uuid('cust_id');
            $table->uuid('product_id');
            $table->string('bukti');
            $table->uuid('status')->nullable();
            $table->timestamps();
            $table->foreign('cust_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade');
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');
            $table->foreign('status')
                  ->references('id')->on('status_bookings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
