<?php

namespace Database\Seeders;

use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use Illuminate\Database\Seeder;

class PaketKuesionerDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket = PaketKuesioner::all()->first();

        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes123',
            'pertanyaan' => 'Apakah kamu suka?',
            'jawaban' => null,
            'tipe' => 'select',
            'id_paket_quesioners' => $paket->id,
            'index' => 1,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1234',
            'pertanyaan' => 'Apakah kamu bisa?',
            'jawaban' => null,
            'tipe' => 'select',
            'id_paket_quesioners' => $paket->id,
            'index' => 2,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1235',
            'pertanyaan' => 'Apakah kamu kuat?',
            'jawaban' => null,
            'tipe' => 'select',
            'id_paket_quesioners' => $paket->id,
            'index' => 3,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1236',
            'pertanyaan' => 'Berikan alasan anda?',
            'jawaban' => null,
            'tipe' => 'text',
            'id_paket_quesioners' => $paket->id,
            'index' => 4,
        ]);
    }
}
