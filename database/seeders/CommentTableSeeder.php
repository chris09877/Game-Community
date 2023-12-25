<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment')->insert([
            [
                'user_id' => 1,
                'parent_id' => null,
                'text' => 'Comment text for the first post.',
                'post_id' => 1,
                'faq_id' => null,
            ],
            [
                'user_id' => 2,
                'parent_id' => 1,
                'text' => 'Reply to the first comment.',
                'post_id' => 1,
                'faq_id' => null,
            ],
            [
                'user_id' => 2,
                'parent_id' => null,
                'text' => 'Reply to the first comment.',
                'post_id' => null,
                'faq_id' => 1,
            ],
                ]);
    }
}
