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
            "fullname" => "mohammad tajut zamzami",
            "nik" => "01928182812012",
            "no_telp" => "085607185972",
            "foto" => "foto.png",
            "linkedin" => "linkedin.com/zam",
            "ttl" => "banyuwangi 10 september 2022",
            'level' => 'user'
        ]);
    }
}