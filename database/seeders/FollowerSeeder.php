<?php

namespace Database\Seeders;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all()->toArray();
        //
        Follower::create([
            'user_id' => $users[0]['id'],
            'folowers_id' => $users[1]['id']
        ]);
        Follower::create([
            'user_id' => $users[0]['id'],
            'folowers_id' => $users[2]['id']
        ]);
    }
}