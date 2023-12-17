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
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'Bio' => 'Some bio information about John Doe',
                'admin' => true, 
                'avatar' => null,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password456'),
                'Bio' => 'Some bio information about Jane Smith',
                'admin' => false, 
                'avatar' => null,

            ],
            // Add more users as needed
        ]);
    }
}
