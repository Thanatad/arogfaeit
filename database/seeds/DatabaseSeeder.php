<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([users::class,daylists::class,ddevents::class,locations::class,user_events::class,favorites::class]);
    }
}
