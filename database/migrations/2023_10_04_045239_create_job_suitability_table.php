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
            $table->boolean('f1601');
            $table->enum('f1602', ['Pekerjaan saya sudah sesuai', 'Pekerjaan saya sudah sesuai-Saya belum mendapatkan pekerjaan yang lebih sesuai', 'Saya belum mendapatkan pekerjaan yang lebih sesuai']);
            $table->boolean('f1603');
            $table->boolean('f1604');
            $table->boolean('f1605');
            $table->boolean('f1606');
            $table->boolean('f1607');
            $table->boolean('f1608');
            $table->boolean('f1609');
            $table->boolean('f1610');
            $table->boolean('f1611');
            $table->boolean('f1612');
            $table->boolean('f1613');
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