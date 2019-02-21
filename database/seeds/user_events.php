<?php

use Illuminate\Database\Seeder;

class user_events extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_events')->insert([
            ['id' => '1', 'user_id' => '1', 'event_id' => '1', 'location_id' => '1', 'destroy' => '0', 'created_at' => '2019-01-31 01:43:26', 'updated_at' => '2019-02-02 10:25:00'],
            ['id' => '2', 'user_id' => '1', 'event_id' => '2', 'location_id' => '2', 'destroy' => '0', 'created_at' => '2019-01-31 02:05:12', 'updated_at' => '2019-01-31 02:05:12'],
            ['id' => '3', 'user_id' => '1', 'event_id' => '3', 'location_id' => '3', 'destroy' => '0', 'created_at' => '2019-01-31 02:14:05', 'updated_at' => '2019-01-31 02:14:05'],
        ]);
    }
}
