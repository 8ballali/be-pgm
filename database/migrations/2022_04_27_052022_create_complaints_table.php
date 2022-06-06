<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->uuid('cust_id');
            $table->uuid('category_id');
            $table->integer('type');
            $table->string('judul');
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->integer('status');
            $table->string('bukti')->nullable();
            $table->integer('feedback_score')->nullable();
            $table->string('feedback_deskripsi')->nullable();
            $table->foreign('cust_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade');
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('complaints');
    }
}
