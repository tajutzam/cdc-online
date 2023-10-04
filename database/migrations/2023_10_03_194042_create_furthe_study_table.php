<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurtheStudyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furthe_study', function (Blueprint $table) {
            $table->id();
            $table->enum('f18a', ['Biaya Sendiri' , 'Bea Siswa'])->nullable(true);
            $table->string('f18b')->nullable(true);
            $table->string('f18c')->nullable(true); 
            $table->timestamp('f18d')->nullable(true);
            $table->string('f1201')->nullable(false);
            $table->string('f1202')->nullable(true);
            $table->enum('f14', [
                'Sangat Erat',
                'Erat',
                'Cukup Erat',
                'Kurang Erat',
                'Tidak sama sekali'
            ])->nullable(false);
            $table->enum('f15', [
                'Setingkat lebih tinggi',
                'Tingkat yang sama',
                'Setingkat lebih rendah',
                'Tidak perlu pendidikan tinggi'
            ])->nullable(true);
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
        Schema::dropIfExists('furthe_study');
    }
}