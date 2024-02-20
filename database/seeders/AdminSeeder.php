<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'name' => 'admin-1',
            'password' => Hash::make('rahasia'),
            'alamat' => 'Jakarta',
            'email' => 'admin@gmail.com',
            'npwp' => '12312k123123',
            'role' => 'admin'
        ]);
        Admin::create([
            'name' => 'prodi-1',
            'password' => Hash::make('rahasia'),
            'alamat' => 'Banyuwangi',
            'email' => 'prodi@gmail.com',
            'npwp' => '12312k123123',
            'role' => 'prodi'
        ]);
    }
}
