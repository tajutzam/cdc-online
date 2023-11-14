<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('comment')->nullable(false);
            // $table->foreignUuid('post_id')->references('id')->on('post')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('post_id')->nullable(true)->references('id')->on('post')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignUuid('user_id')->nullable(true)->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();
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
        Schema::dropIfExists('comments');
    }
}