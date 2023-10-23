<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyMethodTable extends Migration
{


    private $option = [
        'Sangat Besar',
        'Besar',
        'Cukup Besar',
        'Kurang',
        'Tidak Sama Sekali'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_method', function (Blueprint $table) {
            $table->id();
            $table->string('f21');
            $table->string('f22');
            $table->string('f23');
            $table->string('f24');
            $table->string('f25');
            $table->string('f26');
            $table->string('f27');
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
        Schema::dropIfExists('study_method');
    }
}