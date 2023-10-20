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
            $table->string('f1601');
            $table->string('f1602', );
            $table->string('f1603', );
            $table->string('f1604', );
            $table->string('f1605', );
            $table->string('f1606', );
            $table->string('f1607', );
            $table->string('f1608', );
            $table->string('f1609', );
            $table->string('f1610', );
            $table->string('f1611', );
            $table->string('f1612', );
            $table->string('f1613', );
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