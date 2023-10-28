<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowToFindJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('how_to_find_jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('f401');
            $table->boolean('f402');
            $table->boolean('f403');
            $table->boolean('f404');
            $table->boolean('f405');
            $table->boolean('f406');
            $table->boolean('f407');
            $table->boolean('f408');
            $table->boolean('f409');
            $table->boolean('f410');
            $table->boolean('f411');
            $table->boolean('f412');
            $table->boolean('f413');
            $table->boolean('f414');
            $table->boolean('f415');
            $table->string('f416', 255)->nullable(true);
          

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
        Schema::dropIfExists('how_to_find_jobs');
    }
}