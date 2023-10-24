<?php

namespace Database\Seeders;

use App\Models\ProdiAdministrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProdiAdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        ProdiAdministrator::create(
            [
                'email' => 'tif@gmail.com',
                'password' => Hash::make('rahasia'),
                'nik' => '023123123123123123',
                'address' => 'banyuwangi',
                'name' => 'Bapak Oskar Oasis',
                'prodi_id' => 55301
            ]
        );
    }
}
