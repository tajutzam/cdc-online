<? // database/migrations/yyyy_mm_dd_create_paket_kuesioner_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketKuesionerTable extends Migration
{
    public function up()
    {
        Schema::create('paket_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('tipe', ['Tracer Study', 'Survey Khusus']);
            $table->date('tanggal_dibuat');
            $table->string('program_studi')->nullable(); // Tambahkan kolom program studi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket_kuesioner');
    }
}
