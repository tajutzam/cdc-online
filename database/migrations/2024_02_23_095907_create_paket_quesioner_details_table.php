<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketQuesionerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_quesioner_details', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pertanyaan');
            $table->string('pertanyaan');
            $table->bigInteger('tipe_id')->unsigned();
            $table->foreign("tipe_id")->references("id")->on("quesioner_types")->onDelete('cascade');
            $table->bigInteger('id_paket_quesioners')->unsigned();
            $table->foreign('id_paket_quesioners')->references('id')->on('paket_kuesioners')->onDelete('cascade');
            $table->string("is_required")->default(0)->nullable();
            $table->json("options")->nullable();
            $table->integer('index')->default(1);
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
        Schema::dropIfExists('paket_quesioner_details');
    }
}
