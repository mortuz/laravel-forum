<?php

use Illuminate\Database\Seeder;
use App\Like;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\like::create([
            'user_id' => 1,
            'reply_id' => 1
        ]);

        App\like::create([
            'user_id' => 2,
            'reply_id' => 2
        ]);

        App\like::create([
            'user_id' => 1,
            'reply_id' => 2
        ]);
    }
}
