<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_memos', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->uuid('memo_id');
            $table->string('catatan')->nullable();
            $table->string('bukti')->nullable();
            $table->timestamps();
            $table->foreign('memo_id')
            ->references('id')->on('memos')
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
        Schema::dropIfExists('history_memos');
    }
}
