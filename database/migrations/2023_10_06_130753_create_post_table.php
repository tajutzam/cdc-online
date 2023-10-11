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
            $table->uuid('id');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('link_apply')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('company')->nullable(false);
            $table->string('position')->nullable(false);
            $table->timestamp('expired')->nullable(false);
            $table->timestamp('post_at')->default(\Illuminate\Support\Carbon::now());
            $table->string('image')->nullable(false);
            $table->enum('type_jobs', ['Purnawaktu', 'Paruh Waktu', 'Wiraswasta', 'Pekerja Lepas', 'Kontrak', 'Musiman']);
            $table->boolean('can_comment')->default(true);
            $table->boolean('verivied')->default(false);
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