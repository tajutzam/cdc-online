<?php // database/migrations/yyyy_mm_dd_create_paket_kuesioner_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketKuesionerTable extends Migration
{
    public function up()
    {
        Schema::create('paket_kuesioners', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('tipe', ['Tracer Study', 'Survey Khusus']);
            // $table->date('tanggal_dibuat');
            $table->integer('id_quis_identitas_prodi')->nullable();
            $table->foreign('id_quis_identitas_prodi')->references('id')->on('quis_identitas_prodi'); // Tambahkan kolom program studi
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket_kuesioners');
    }
}
