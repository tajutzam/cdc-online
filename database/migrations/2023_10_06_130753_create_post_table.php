<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable(true)->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignUuid('admin_id')->nullable(true)->references('id')->on('admin')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('link_apply')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('company')->nullable(false);
            $table->string('position')->nullable(false);
            $table->timestamp('expired')->nullable(false);
            $table->timestamp('post_at')->default(\Illuminate\Support\Carbon::now());
            $table->string('image')->nullable(false);
            $table->string('type_jobs', );
            $table->boolean('can_comment')->default(true);
            $table->enum('verified', ['waiting', 'verified', 'rejected'])->default('waiting');
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
        Schema::dropIfExists('post');
    }
}