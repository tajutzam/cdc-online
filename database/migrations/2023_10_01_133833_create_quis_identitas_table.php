<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuisIdentitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quis_identitas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kdptimsmh')->default("005019");
            $table->integer('kdpstmsmh');
            $table->string('nimhsmsmh');
            $table->string('nmmhsmsmh');
            $table->string('telpomsmh');
            $table->string('emailmsmh');
            $table->integer('tahun_lulus');
            $table->string('nik');
            $table->string('npwp');
            $table->foreign('kdpstmsmh')->references('id')->on('quis_identitas_prodi')->cascadeOnDelete()->cascadeOnDelete();
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
        Schema::dropIfExists('quis_identitas');
    }
}