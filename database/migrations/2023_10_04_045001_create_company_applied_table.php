<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAppliedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_applied', function (Blueprint $table) {
            $table->id();
            $table->integer('f6');
            $table->integer('f7');
            $table->integer('f7a');
            $table->enum('f1001', [
                'Tidak',
                'Tidak, tapi saya sedang menunggu hasil lamaran kerja',
                'Ya, saya akan mulai bekerja dalam 2 minggu ke depan',
                'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan',
                'Lainnya'
            ]);
            $table->string('f1002');
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
        Schema::dropIfExists('company_applied');
    }
}