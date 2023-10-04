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
            $table->enum('f21', $this->option);
            $table->enum('f22', $this->option);
            $table->enum('f23', $this->option);
            $table->enum('f24', $this->option);
            $table->enum('f25', $this->option);
            $table->enum('f26', $this->option);
            $table->enum('f27', $this->option);
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