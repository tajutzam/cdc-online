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
            $table->string('f8')->nullable(false);
            $table->boolean('f504')->nullable(false);
            $table->integer('f502')->nullable(false);
            $table->string('f505')->nullable(false);
            $table->integer('f506')->nullable(false);
            
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
