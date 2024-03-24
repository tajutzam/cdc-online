<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurusan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quesioner_jurusans_id');
            $table->foreign('quesioner_jurusans_id')->references('id')->on('quesioner_jurusans');
            $table->integer('quis_identitas_prodi_id');
            $table->foreign('quis_identitas_prodi_id')->references('id')->on('quis_identitas_prodi');
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
        Schema::dropIfExists('jurusan_details');
    }
}
