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
            'judul' => 'Quesioner Test',
            'tipe' => 'Tracer Study'
        ]);
    }
}
