<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            "email" => "test@gmail.com",
            "password" => Hash::make("rahasia"),
            "fullname" => "Mohammad Tajut Zam Zami",
            "nik" => "01928182812012",
            "no_telp" => "085607185972",
            "foto" => "foto.png",
            "linkedin" => "linkedin.com/zam",
            'level' => 'user',
            "alamat" => 'Jawa Timur , Banyuwangi',
            'gender' => 'male',
            'about' => "Saya adalah orang yang memiliki tekat yang tinggi",
            'email_verivied' => 1,
            'kode_prodi' => 55301,
            'nim' => 'e41212337'
        ]);
        User::create([
            "email" => "second@gmail.com",
            "password" => Hash::make("rahasia"),
            "fullname" => "Second User",
            "nik" => "01928182812013",
            "no_telp" => "085607185972",
            "foto" => "foto.png",
            "linkedin" => "linkedin.com/zam",
            'level' => 'user',
            "alamat" => 'Jawa Timur , Banyuwangi',
            'gender' => 'male',
            'about' => "Saya second choice",
            'email_verivied' => 1,
            'kode_prodi' => 79402,
            'nim' => 'e41212336'
        ]);
        User::create([
            "email" => "fasihullisan091966@gmail.com",
            "password" => Hash::make("rahasia"),
            "fullname" => "Ach. Fasihul Lisan",
            "nik" => "0643267544645",
            "no_telp" => "085336076077",
            "foto" => "foto.png",
            "linkedin" => "linkedin.com/fasihll",
            'level' => 'user',
            "alamat" => 'Jawa Timur , Bangkalan',
            'gender' => 'male',
            'about' => "Saya third choice",
            'email_verivied' => 1,
            'kode_prodi' => 79402,
            'nim' => 'e41211994'
        ]);
    }
}
