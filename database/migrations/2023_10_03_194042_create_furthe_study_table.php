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
            $table->uuid('id')->primary();
            $table->string('f18a')->nullable(true);
            $table->string('f18b')->nullable(true);
            $table->string('f18c')->nullable(true);
            $table->timestamp('f18d')->nullable(true);
            $table->string('f1201')->nullable(false);
            $table->string('f1202')->nullable(true);
            $table->string('f14')->nullable(false);
            $table->string('f15', )->nullable(true);
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