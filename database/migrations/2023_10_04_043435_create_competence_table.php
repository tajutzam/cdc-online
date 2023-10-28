<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceTable extends Migration
{


    private $option = [
        'Sangat Rendah',
        'Rendah',
        'Netral',
        'Tinggi',
        'Sangat Tinggi'
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('f1761');
            $table->string('f1762');
            $table->string('f1763');
            $table->string('f1764');
            $table->string('f1765');
            $table->string('f1766');
            $table->string('f1767');
            $table->string('f1768');
            $table->string('f1769');
            $table->string('f1770');
            $table->string('f1771');
            $table->string('f1772');
            $table->string('f1773');
            $table->string('f1774');
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
        Schema::dropIfExists('competence');
    }
}