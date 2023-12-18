<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Mitra::create([
            'logo' => 'default.jpg', // Replace with the actual path to your logo file
            'name' => 'test mitra',
            'nib' => '101212',
            'business_license' => '12312.pdf',
            'phone' => '085607185972',
            'address' => 'bwi',
            'email' => 'mohammadtajutzamzami07@gmail.com',
            'password' => Hash::make('rahasia'), // Replace 'your_password' with the desired password
            
        ]);
    }
}
