<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProdiAdministrator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            QuisProdiSeeder::class,
            ProvinceSeeder::class,
            RegencySeeder::class,
            AdminSeeder::class,
            ProdiAdministratorSeeder::class,
            UserSeeder::class,
            MitraSeeder::class,
            QuesionerTypeSeeder::class,
            PaketKuesionerSeeder::class,
            PaketKuesionerDetailSeeder::class,
            QuesionerJurusanSeeder::class,
            JurusanDetailSeeder::class
        ]);
    }
}
