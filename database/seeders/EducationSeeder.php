<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::where('email', "test@gmail.com")->first();
        $secondUser = User::where('email', "second@gmail.com")->first();


        Education::create(
            [
                'user_id' => $user->id,
                "strata" => "D4",
                "jurusan" => "Teknologi Informasi",
                "prodi" => "Teknik Infomatika",
                "tahun_masuk" => "2020",
                "tahun_lulus" => "2022",
                "perguruan" => "Politeknik Negeri Jember"
            ]
        );
        Education::create(
            [
                'user_id' => $secondUser->id,
                "strata" => "D4",
                "jurusan" => "Teknologi Informasi",
                "prodi" => "Teknik Infomatika",
                "tahun_masuk" => "2014",
                "tahun_lulus" => "2022",
                "perguruan" => "Politeknik Negeri Jember"
            ]
        );

    }
}