<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuisionerLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quisioner_level', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // noob
            $table->boolean('identitas_section')->default(false);
            $table->boolean('main_section')->default(false);
            $table->boolean('furthe_study_section')->default(false);
            // beginner
            $table->boolean('competent_level_section')->default(false);
            $table->boolean('study_method_section')->default(false);
            $table->boolean('jobs_street_section')->default(false);
            // intermediate
            $table->boolean('how_find_jobs_section')->default(false);
            $table->boolean('company_applied_section')->default(false);
            $table->boolean('job_suitability_section')->default(false);
            $table->enum('level', ['0', '6', '12']);
            $table->timestamp('expired');
            // star
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
        Schema::dropIfExists('quisioner_level');
    }
}