<?php

namespace Database\Seeders;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::where('email', 'test@gmail.com')->first();

        Jobs::create([
            'user_id' => $user->id,
            'perusahaan' => "BUMN",
            'jabatan' => "Backend Developer",
            'gaji' => 20000000,
            'jenis_pekerjaan' => "Tetap",
            'tahun_masuk' => 2022,
            'pekerjaan_saatini' => true
        ]);
        Jobs::create([
            'user_id' => $user->id,
            'perusahaan' => "BUMN",
            'jabatan' => "Backend Developer",
            'gaji' => 20000000,
            'jenis_pekerjaan' => "Tetap",
            'tahun_masuk' => 2022,
            "tahun_keluar" => 2023,
            'pekerjaan_saatini' => false
        ]);
    }
}
