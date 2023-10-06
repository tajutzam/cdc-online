<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSuitabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_suitability', function (Blueprint $table) {
            $table->id();
            $table->enum('f1601' , ['Tidak sesuai' , 'Pekerjaan saya sekarang sudah sesuai dengan pendidikan saya']);
            $table->enum('f1602', ['Pekerjaan saya sudah sesuai', 'Pekerjaan saya sudah sesuai-Saya belum mendapatkan pekerjaan yang lebih sesuai', 'Saya belum mendapatkan pekerjaan yang lebih sesuai']);
            $table->enum('f1603' , ['Pekerjaan saya sudah sesuai', 'Di pekerjaan ini saya memeroleh prospek karir yang baik']);
            $table->enum('f1604' , ['Pekerjaan saya sudah sesuai' , 'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya
            ']);
            $table->enum('f1605' ,['Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya' ,'Pekerjaan saya sudah sesuai']);
            $table->enum('f1606' , ['Pekerjaan saya sudah sesuai' , 'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini']);
            $table->enum('f1607' , ['Pekerjaan saya sudah sesuai' , 'Pekerjaan saya saat ini lebih aman/terjamin/secure']);
            $table->enum('f1608' ,['Pekerjaan saya sudah sesuai' , 'Pekerjaan saya saat ini lebih menarik']);
            $table->enum('f1609' , ['Pekerjaan saya sudah sesuai' , 'Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel dll']);
            $table->enum('f1610' , ['Pekerjaan saya sudah sesuai' , 'Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya']);
            $table->enum('f1611' , ['Pekerjaan saya sudah sesuai' , 'Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya']);
            $table->enum('f1612' , ['Pekerjaan saya sudah sesuai' , 'Pada awal meniti karir ini saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya']);
            $table->enum('f1613' , ['Pekerjaan saya sudah sesuai','Lainnya']);
            $table->string('f1614');
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('job_suitability');
    }
}