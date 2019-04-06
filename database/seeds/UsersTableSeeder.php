<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'admin@laravelforum.dev',
            'admin' => 1,
            'avatar' => asset('avatars/avatar.png')
        ]);

        App\User::create([
            'name' => 'Indrani Paul',
            'display_name'  => 'Indrani',
            'password' => bcrypt('password'),
            'email' => 'indrani@laravelforum.dev',
            'avatar' => asset('avatars/avatar.png')
        ]);
    }
}
