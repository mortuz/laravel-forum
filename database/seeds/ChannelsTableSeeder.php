<?php

use Illuminate\Database\Seeder;

use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create(['title' => 'Laravel', 'slug' => str_slug('Laravel')]);
        Channel::create(['title' => 'Flutter', 'slug' => str_slug('Flutter')]);
        Channel::create(['title' => 'React Native', 'slug' => str_slug('React Native')]);
        Channel::create(['title' => 'Dart', 'slug' => str_slug('Dart')]);
        Channel::create(['title' => 'Vue', 'slug' => str_slug('Vue')]);
        Channel::create(['title' => 'JavaScript', 'slug' => str_slug('JavaScript')]);
    }
}
