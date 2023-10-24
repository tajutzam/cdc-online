<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('alamat_domisili')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('email')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nim')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('ijazah');
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
        Schema::dropIfExists('alumni_submissions');
    }
}
