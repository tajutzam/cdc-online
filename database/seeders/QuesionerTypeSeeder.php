<?php

namespace Database\Seeders;

use App\Models\QuesionerType;
use Illuminate\Database\Seeder;

class QuesionerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuesionerType::create([
            'value' => "text",
            'display_value' => "Input Text"
        ]);
        QuesionerType::create([
            'value' => "number",
            'display_value' => "Input Angka"
        ]);
        QuesionerType::create([
            'value' => "email",
            'display_value' => "Input E-Mail"
        ]);
        QuesionerType::create([
            'value' => "url",
            'display_value' => "Input URL / Link"
        ]);
        QuesionerType::create([
            'value' => "datetime-local",
            'display_value' => "Input Tanggal & Waktu"
        ]);
        QuesionerType::create([
            'value' => "date",
            'display_value' => "Input Tanggal"
        ]);
        QuesionerType::create([
            'value' => "time",
            'display_value' => "Input Waktu"
        ]);
        QuesionerType::create([
            'value' => "select",
            'display_value' => "Input Pilihan"
        ]);
        QuesionerType::create([
            'value' => "select_jurusan",
            'display_value' => "Input Nama Jurusan (DB Alumni)"
        ]);
        QuesionerType::create([
            'value' => "select_prodi",
            'display_value' => "Input Nama Prodi (DB Alumni)"
        ]);
        QuesionerType::create([
            'value' => "select_epsbed",
            'display_value' => "Input Kode Prodi / EPSBED (DB Prodi)"
        ]);
        QuesionerType::create([
            'value' => "checkbox",
            'display_value' => "Input Checkbox"
        ]);
    }
}
