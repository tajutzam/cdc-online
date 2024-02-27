<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_jawabans', function (Blueprint $table) {
            $table->id();
            $table->string('display_value');
            $table->bigInteger('id_paket_quesioner_detail')->unsigned();
            $table->foreign('id_paket_quesioner_detail')->references('id')->on('paket_quesioner_details')->onDelete('cascade');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_jawabans');
    }
}
