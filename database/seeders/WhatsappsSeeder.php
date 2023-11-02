<?php

namespace Database\Seeders;

use App\Models\Whatsapps;
use Illuminate\Database\Seeder;

class WhatsappsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Whatsapps::create(
            [
                'image' => 'Jembercity.jpg',
                'url' => 'https://chat.whatsapp.com/HDI56SKTvuv0JPTVUI3OIS',
                'name' => 'IKAPJ Domisili Jember'
            ]
        );
    }
}
