<?php

namespace Database\Seeders;

use App\Models\QuesionerJurusan;
use Illuminate\Database\Seeder;

class QuesionerJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuesionerJurusan::create([
            "nama_jurusan" => "TEKNOLOGI PERTANIAN",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "PRODUKSI PERTANIAN",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "PETERNAKAN",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "MANAJEMEN AGRIBISNIS",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "KESEHATAN",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "TEKNOLOGI INFORMASI",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "TEKNIK",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "BAHASA KOMUNIKASI DAN PARIWISATA",
        ]);
        QuesionerJurusan::create([
            "nama_jurusan" => "BISNIS",
        ]);
    }
}
