<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id_pengirim');
            $table->unsignedBigInteger('employee_id_penerima');
            $table->unsignedBigInteger('meeting_id')->nullabe();
            $table->string('judul');
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('employee_id_pengirim')
                  ->references('id')->on('employees')
                  ->onDelete('cascade');
            $table->foreign('employee_id_penerima')
                  ->references('id')->on('employees')
                  ->onDelete('cascade');
            $table->foreign('meeting_id')
                  ->references('id')->on('meetings')
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
        Schema::dropIfExists('memos');
    }
}
