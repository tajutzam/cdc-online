<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('education', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable(false);
            $table->enum('strata', ["D3", "D4", "S1", "S2", "S3"])->nullable(true);
            $table->string('jurusan')->nullable(true);
            $table->string('prodi')->nullable(true);
            $table->integer('tahun_masuk')->nullable(true);
            $table->integer('tahun_lulus')->nullable(true);
            $table->string('no_ijasah')->nullable(true);
            $table->string('perguruan')->nullable(false)->default('Polteknik Negeri Jember');
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
        //
        Schema::dropIfExists('education');
    }

};