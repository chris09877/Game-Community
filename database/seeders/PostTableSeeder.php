<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::pluck('id'); // Get all existing user IDs
        // foreach ($users as $userId) {

        DB::table('post')->insert([
            [
                'user_id' => 1,
                'image' => null,
                'content' => 'Some content for the first post.',
                'title' => 'First Post',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'image' => null,
                'content' => 'Some content for the second post.',
                'title' => 'Second Post',
                'created_at' => now(),

            ]
            // Add more posts as needed
        ]);
    // }
    }
}
