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
        $users = \App\Models\User::pluck('id');
        DB::table('post')->insert([
            [
                'user_id' => 1,
                'image' => 'posts/post.jpg',
                'content' => 'Some content for the first post.',
                'title' => 'First Post',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'image' => 'posts/post.jpg',
                'content' => 'Some content for the second post.',
                'title' => 'Second Post',
                'created_at' => now(),

            ]
        ]);
    // }
    }
}
