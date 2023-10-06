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
            $table->id();
            $table->enum('f1761', $this->option);
            $table->enum('f1762', $this->option);
            $table->enum('f1763', $this->option);
            $table->enum('f1764', $this->option);
            $table->enum('f1765', $this->option);
            $table->enum('f1766', $this->option);
            $table->enum('f1767', $this->option);
            $table->enum('f1768', $this->option);
            $table->enum('f1769', $this->option);
            $table->enum('f1770', $this->option);
            $table->enum('f1771', $this->option);
            $table->enum('f1772', $this->option);
            $table->enum('f1773', $this->option);
            $table->enum('f1774', $this->option);
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
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