<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('perusahaan')->nullable(false);
            $table->string('jabatan')->nullable(false);
            $table->integer('gaji')->nullable(false);
            $table->string('jenis_pekerjaan')->nullable(false);
            $table->string('tahun_masuk')->nullable(false);
            $table->string('tahun_keluar')->nullable(true);
            $table->boolean('pekerjaan_saatini')->default(false);
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
        Schema::dropIfExists('jobs');
    }
}