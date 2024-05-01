<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = User::all();
        $postIds = Post::pluck('id')->toArray(); // Get all post IDs as an array

        foreach ($users as $user) {
            $randomPostIds = array_rand($postIds, rand(1, 5)); // Select 1-5 posts randomly for each user

            foreach ($randomPostIds as $postId) {
                $user->likedPosts()->attach($postId); // Attach each post to the user
            }
        }

    }
}
