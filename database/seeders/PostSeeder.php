<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class PostSeeder extends Seeder
{
    use WithFaker;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::all()->first();

        Post::create([
            'image' => 'image',
            'link_apply' => 'link',
            'description' => 'description',
            'company' => 'poltek',
            'position' => 'honor',
            'type_jobs' => 'Paruh Waktu',
            'expired' => Carbon::now()->addWeek(),
            'user_id' => $user->id,
            'verified' => 'waiting'
        ]);
    }
}