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
            'tipe_id' => 8,
            'id_paket_quesioners' => $paket->id,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 1,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1234',
            'pertanyaan' => 'Apakah kamu bisa?',
            'tipe_id' => 8,
            'id_paket_quesioners' => $paket->id,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 2,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1235',
            'pertanyaan' => 'Apakah kamu kuat?',
            'tipe_id' => 8,
            'id_paket_quesioners' => $paket->id,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 3,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes123545',
            'pertanyaan' => 'pilih yang kamu suka?',
            'tipe_id' => 12,
            'id_paket_quesioners' => $paket->id,
            'is_required' => 1,
            'options' => json_encode(["fasih", "ahnaf", "marzuki"]),
            'index' => 4,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1235',
            'pertanyaan' => 'Apakah kamu kuat?',
            'tipe_id' => 8,
            'id_paket_quesioners' => $paket->id,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 5,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1236',
            'pertanyaan' => 'Berikan alasan anda?',
            'tipe_id' => 1,
            'id_paket_quesioners' => $paket->id,
            'is_required' => 1,
            'index' => 6,
        ]);
    }
}
