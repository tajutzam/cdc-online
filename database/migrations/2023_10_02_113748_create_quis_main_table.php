<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuisMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quis_main', function (Blueprint $table) {
            $table->id();
            $table->enum('f8', ['Bekerja (full time/part time)', 'Belum memungkinkan bekerja', 'Wiraswasta', 'Melanjutkan Pendidikan', 'Tidak kerja tetapi sedang mencari kerja'])->nullable(false);
            $table->boolean('f504')->nullable(false);
            $table->integer('f502')->nullable(false);
            $table->string('f505')->nullable(false);
            $table->string('f5a1')->nullable(false);
            $table->string('f5a2')->nullable(false);
            $table->integer('f506')->nullable(false);
            $table->string('f1101')->nullable(false);
            $table->string('f5b')->nullable(false);
            $table->enum('f5c', ['Founder', 'Co-Founder', 'Staff', 'Freelance/Kerja Lepas'])->nullable(false);
            $table->enum('f5d', ['Lokal/wilayah/wiraswasta tidak berbadan hukum', 'Nasional/wiraswasta berbadan hukum', 'Multinasional/Internasional']);
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
        Schema::dropIfExists('quis_main');
    }
}