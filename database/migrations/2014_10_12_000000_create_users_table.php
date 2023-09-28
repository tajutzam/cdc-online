<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('ttl', 500)->nullable(true);
            $table->string('nik', 17)->unique();
            $table->string('no_telp', 15);
            $table->enum('gender', ['female', 'male'])->nullable(true);
            $table->string('about', 500)->nullable(true);
            $table->string('alamat', 255)->nullable(false);
            $table->boolean('visible_alamat')->default(true);
            $table->boolean('visible_email')->default(false);
            $table->boolean('visible_fullname')->default(true);
            $table->boolean('visible_ttl')->default(true);
            $table->boolean('visible_nik')->default(true);
            $table->boolean('visible_no_telp')->default(true);
            $table->string('foto', 255)->nullable(true);
            $table->string('linkedin')->nullable(true);
            $table->string('twiter')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('token')->nullable(true);
            $table->timestamp('token_expire')->nullable(true);
            $table->enum('level', ['user', 'admin']);
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
};