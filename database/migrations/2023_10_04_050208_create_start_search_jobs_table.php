<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartSearchJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('start_search_jobs', function (Blueprint $table) {
            $table->id();
            $table->enum('f301', ['Saya mencari kerja sebelum lulus', 'Saya mencari kerja sesudah wisuda', 'Saya tidak mencari kerja']);
            $table->integer('f302');
            $table->integer('f303');
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
        Schema::dropIfExists('start_search_jobs');
    }
}