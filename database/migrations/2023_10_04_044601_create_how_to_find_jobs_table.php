<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowToFindJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('how_to_find_jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('f401')->default(false);
            ;
            $table->boolean('f402')->default(false);
            $table->boolean('f403')->default(false);
            ;
            $table->boolean('f404')->default(false);
            ;
            $table->boolean('f405')->default(false);
            ;
            $table->boolean('f406')->default(false);
            ;
            $table->boolean('f407')->default(false);
            ;
            $table->boolean('f408')->default(false);
            ;
            $table->boolean('f409')->default(false);
            ;
            $table->boolean('f410')->default(false);
            ;
            $table->boolean('f411')->default(false);
            ;
            $table->boolean('f412')->default(false);
            ;
            $table->boolean('f413')->default(false);
            ;
            $table->boolean('f414')->default(false);
            ;
            $table->boolean('f415')->default(false);
            ;
            $table->text('f416')->nullable(true);


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
        Schema::dropIfExists('how_to_find_jobs');
    }
}