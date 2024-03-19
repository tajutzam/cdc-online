<?php

namespace Database\Seeders;

use App\Models\Jurusan_detail;
use Illuminate\Database\Seeder;

class JurusanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //teknologi prtanian
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 1,
            'quis_identitas_prodi_id' => 41401
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 1,
            'quis_identitas_prodi_id' => 41421
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 1,
            'quis_identitas_prodi_id' => 41203
        ]);

        //produksi pertanian
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 2,
            'quis_identitas_prodi_id' => 54371
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 2,
            'quis_identitas_prodi_id' => 54357
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 2,
            'quis_identitas_prodi_id' => 54412
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 2,
            'quis_identitas_prodi_id' => 54471
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 2,
            'quis_identitas_prodi_id' => 41331
        ]);

        //peternakan
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 3,
            'quis_identitas_prodi_id' => 54331
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 3,
            'quis_identitas_prodi_id' => 54432
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 3,
            'quis_identitas_prodi_id' => 54317
        ]);

        //manajemen agribisnis
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 4,
            'quis_identitas_prodi_id' => 54101
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 4,
            'quis_identitas_prodi_id' => 54401
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 4,
            'quis_identitas_prodi_id' => 54402
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 4,
            'quis_identitas_prodi_id' => 41311
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 4,
            'quis_identitas_prodi_id' => 41312
        ]);

        //kesehatan
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 5,
            'quis_identitas_prodi_id' => 13311
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 5,
            'quis_identitas_prodi_id' => 13363
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 5,
            'quis_identitas_prodi_id' => 13331
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 5,
            'quis_identitas_prodi_id' => 13362
        ]);

        //teknologi informasi
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 6,
            'quis_identitas_prodi_id' => 61316
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 6,
            'quis_identitas_prodi_id' => 57401
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 6,
            'quis_identitas_prodi_id' => 55301
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 6,
            'quis_identitas_prodi_id' => 55302
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 6,
            'quis_identitas_prodi_id' => 55304
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 6,
            'quis_identitas_prodi_id' => 56401
        ]);

        //teknik
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 7,
            'quis_identitas_prodi_id' => 21301
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 7,
            'quis_identitas_prodi_id' => 21306
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 7,
            'quis_identitas_prodi_id' => 21312
        ]);

        //inggris komunikasi
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 8,
            'quis_identitas_prodi_id' => 79402
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 8,
            'quis_identitas_prodi_id' => 93304
        ]);

        //bisnis
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 9,
            'quis_identitas_prodi_id' => 62303
        ]);
        Jurusan_detail::create([
            'quesioner_jurusans_id' => 9,
            'quis_identitas_prodi_id' => 93308
        ]);
    }
}
