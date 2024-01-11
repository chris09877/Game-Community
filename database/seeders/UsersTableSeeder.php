<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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
                'name' => 'John Doe',
                'email' => 'jo@example.com',
                'password' => Hash::make('password123'),
                'Bio' => 'Some bio information about John Doe',
                'admin' => true, 
                'avatar' => 'profiles/1.jpg',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jan8e@example.com',
                'password' => Hash::make('password456'),
                'Bio' => 'Some bio information about Jane Smith',
                'admin' => false, 
                'avatar' => 'profiles/2.jpg',

            ],
            [
                'name' => 'admin',
                'email' => 'admin@ehb.be',
                'password' => Hash::make('Password!321'),
                'Bio' => 'Some bio information about admin',
                'admin' => true, 
                'avatar' => 'profiles/3.jpg',

            ],
        
        ]);
    }
}
