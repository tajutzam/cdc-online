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
            $table->string('alamat', 255)->nullable(true);
            $table->boolean('visible_alamat')->default(true);
            $table->boolean('visible_email')->default(true);
            $table->boolean('visible_fullname')->default(true);
            $table->boolean('visible_ttl')->default(true);
            $table->boolean('visible_nik')->default(false);
            $table->boolean('visible_no_telp')->default(false);
            $table->string('foto', 255)->nullable(true);
            $table->string('linkedin')->nullable(true);
            $table->string('twiter')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('token')->nullable(true);
            $table->timestamp('token_expire')->nullable(true);
            $table->enum('level', ['user', 'admin']);
            $table->string('password');
            $table->boolean('account_status')->default(false);
            $table->boolean('email_verivied')->default(false);
            $table->timestamp('expire_email')->nullable(true);
            $table->string('fcm_token')->nullable(true);
            $table->string('nim')->unique();
            $table->integer('kode_prodi')->nullable();
            $table->enum('state_quisioner', [0, 6, 12])->default(0);
            $table->foreign('kode_prodi')->references('id')->on('quis_identitas_prodi')->onDelete('set null');
            $table->string('longtitude')->nullable();
            $table->string('latitude')->nullable();
            $table->boolean('required_to_fill')->default(true);
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