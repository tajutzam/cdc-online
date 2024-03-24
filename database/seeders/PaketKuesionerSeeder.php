<?php

namespace Database\Seeders;

use App\Models\PaketKuesioner;
use App\Models\QuisionerIdentitas;
use App\Models\QuisionerProdi;
use Illuminate\Database\Seeder;

class PaketKuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $prodi = QuisionerProdi::where('id', '55301')->first();

        PaketKuesioner::create([
            'judul' => 'Quesioner khusus',
            'tipe' => 'Survey Khusus',
            'id_quis_identitas_prodi' => 55301
        ]);

        PaketKuesioner::create([
            'judul' => 'Tracer Study Polije',
            'tipe' => 'Tracer Study'
        ]);
    }
}
