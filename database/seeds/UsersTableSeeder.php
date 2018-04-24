<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
                'name' => 'Test User',
                'email' => 'test@user.com',
                'password' => bcrypt('testuser'),
                'is_admin' => true
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@website.com',
                'password' => bcrypt('admin'),
                'is_admin' => false
            ]
        ]);
    }
}
