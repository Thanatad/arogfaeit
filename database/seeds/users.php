<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            [
            'id' => 1,
            'full_name' => 'Administrator',
            'base_avatar' => 'avatar.jpg',
            'role' => 3,
            'email' => 'admin@admin.com',
            'acc_type' => 'email',
            'email_verified_at' => '2018-12-08 16:11:53',
            'password' => '$2y$10$RCG5sBHtIUJ5U2lpZ1hYQO13Zf59ANV/Lkqfc4vdl2.cAyfQwEv92',
            'remember_token' => 'lLoXr6FhXalIl3Li9OZ8KYbXaHF2m1toysKE96bar8znAkH8qPs8hmXIV2cD',
            'created_at' => '2018-12-08 16:11:23',
            'updated_at' => '2018-12-08 16:11:53'
            ],
            [
            'id' => 2,
            'full_name' => 'Approver',
            'base_avatar' => 'avatar.jpg',
            'role' => 2,
            'email' => 'approver@approver.com',
            'acc_type' => 'email',
            'email_verified_at' => '2018-12-08 17:07:57',
            'password' => '$2y$10$eHrtkBEZ4GTcx8F24ojYEu6d069nP4A5NM9LyShFjErxOj56QVUq.',
            'remember_token' => 'bWZ3ceUZTr3dgCAbqUjI2uC5cQHOYyLSpNQR1SPl0jjhY3NyGgqS3IC7eyam',
            'created_at' => '2018-12-08 17:07:43',
            'updated_at' => '2018-12-08 17:07:57'
            ],
            [
            'id' => 3,
            'full_name' => 'User',
            'base_avatar' => 'avatar.jpg',
            'role' => 1,
            'email' => 'user@user.com',
            'acc_type' => 'email',
            'email_verified_at' => '2018-12-08 17:12:11',
            'password' => '$2y$10$fR8JF25eSLpyi1m1ZlF2jOiuA66QIo6syADcrdtUwP5JxYJjMKIk.',
            'remember_token' => 'TFe8zDL7zypF5VuYSVqsJX919sl6Qz2xlDwXIzfb8c3ej4o9Kgpk8tMAj01z',
            'created_at' => '2018-12-08 17:11:57',
            'updated_at' => '2018-12-08 17:12:11'
            ]
        ]);
    }
}
