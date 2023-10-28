<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAppliedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_applied', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('f6');
            $table->integer('f7');
            $table->integer('f7a');
            $table->string('f1001');
            $table->string('f1002');
           

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
        Schema::dropIfExists('company_applied');
    }
}