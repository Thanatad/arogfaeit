<?php

use Illuminate\Database\Seeder;

class favorites extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->insert([
            ['id' => '1', 'user_id' => '3', 'event_id' => '1', 'created_at' => '2019-01-31 01:48:32', 'updated_at' => '2019-01-31 01:48:32'],
            ['id' => '2', 'user_id' => '3', 'event_id' => '2', 'created_at' => '2019-02-01 06:14:15', 'updated_at' => '2019-02-01 06:14:15'],
            ['id' => '3', 'user_id' => '3', 'event_id' => '3', 'created_at' => '2019-02-01 06:17:08', 'updated_at' => '2019-02-01 06:17:08']
        ]);
    }
}
