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
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('level', ["0", "6", "12"]);

            $table->foreignUuid('identitas_section')->nullable()->references('id')->on('quis_identitas');
            $table->foreignUuid('main_section')->nullable()->references('id')->on('quis_main');
            $table->foreignUuid('furthe_study_section')->nullable()->references('id')->on('furthe_study');
            $table->foreignUuid('competent_level_section')->nullable()->references('id')->on('competence');
            $table->foreignUuid('study_method_section')->nullable()->references('id')->on('study_method');
            $table->foreignUuid('jobs_street_section')->nullable()->references('id')->on('start_search_jobs');
            $table->foreignUuid('how_find_jobs_section')->nullable()->references('id')->on('how_to_find_jobs');
            $table->foreignUuid('company_applied_section')->nullable()->references('id')->on('company_applied');

            $table->foreignUuid('job_suitability_section')->nullable()->references('id')->on('job_suitability');
            $table->timestamp('expired');
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