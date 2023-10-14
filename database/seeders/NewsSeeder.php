<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create('id_ID');
        News::create([
            'title' => 'Polije Membangun sekolah baru',
            'description' => $faker->sentence,
            'active' => true,
            'image' => 'image',
            'admin_id' => Admin::all()->first()->id
        ]);
    }
}