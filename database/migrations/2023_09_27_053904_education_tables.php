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
            $table->id();
            $table->string('user_id')->nullable(false);
            $table->string('lulusan')->nullable(false);
            $table->string('jurusan')->nullable(false);
            $table->string('prodi')->nullable(false);
            $table->integer('tahun_masuk');
            $table->integer('tahun_lulus')->nullable(true);
            $table->string('no_ijasah')->nullable(true);
            $table->string('perguruan')->nullable(false);
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