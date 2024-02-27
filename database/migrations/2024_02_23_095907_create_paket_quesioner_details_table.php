<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketQuesionerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_quesioner_details', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pertanyaan');
            $table->string('pertanyaan');
            $table->string('jawaban')->nullable();
            $table->enum('tipe', [
                "text",
                "number",
                "email",
                "url",
                "datetime-local",
                "date",
                "time",
                "select",
                "select_jurusan",
                "select_prodi",
                "select_epsbed",
                "checkbox"
            ]);
            $table->bigInteger('id_paket_quesioners')->unsigned();
            $table->foreign('id_paket_quesioners')->references('id')->on('paket_kuesioners')->onDelete('cascade');
            $table->integer('index')->default(1);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_quesioner_details');
    }
}
