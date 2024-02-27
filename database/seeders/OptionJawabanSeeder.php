<?php

namespace Database\Seeders;

use App\Models\OptionJawaban;
use App\Models\PaketQuesionerDetail;
use Illuminate\Database\Seeder;

class OptionJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail = PaketQuesionerDetail::all();

        OptionJawaban::create([
            'display_value' => 'Ya',
            'id_paket_quesioner_detail' => $detail[1]->id
        ]);
        OptionJawaban::create([
            'display_value' => 'Tidak',
            'id_paket_quesioner_detail' => $detail[1]->id
        ]);


        OptionJawaban::create([
            'display_value' => 'Ya',
            'id_paket_quesioner_detail' => $detail[2]->id
        ]);
        OptionJawaban::create([
            'display_value' => 'Tidak',
            'id_paket_quesioner_detail' => $detail[2]->id
        ]);


        OptionJawaban::create([
            'display_value' => 'Ya',
            'id_paket_quesioner_detail' => $detail[3]->id
        ]);
        OptionJawaban::create([
            'display_value' => 'Tidak',
            'id_paket_quesioner_detail' => $detail[3]->id
        ]);
    }
}
