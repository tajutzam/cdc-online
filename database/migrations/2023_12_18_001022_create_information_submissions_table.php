<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('title');
            $table->text('description');
            $table->string('poster');
            $table->string('bukti');
            $table->timestamp('expired')->nullable();
            $table->enum('status' , ['verified' , 'rejected' , 'waiting'])->default('waiting');
            $table->foreignUuid('pay_id')->references('id')->on('pays')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('bank_id')->references('id')->on('banks')->cascadeOnDelete()->cascadeOnUpdate(); 
            $table->foreignUuid('mitra_id')->references('id')->on('mitra')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('informations');
    }
}
