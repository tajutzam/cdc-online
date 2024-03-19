<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuesionerAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quesioner_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quesioner_answer_detail_id');
            $table->foreign('quesioner_answer_detail_id')->references('id')->on('quesioner_answer_details');
            $table->unsignedBigInteger('id_paket_quesioner_detail');
            $table->foreign('id_paket_quesioner_detail')->references('id')->on('paket_quesioner_details');
            $table->json('answer_value');
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
        Schema::dropIfExists('quesioner_answers');
    }
}
