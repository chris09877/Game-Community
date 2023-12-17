<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq')->insert([
            [
                'user_id' => 1,
                'title' => 'Feedback Title 1',
                'text' => 'Some feedback content for the first user.',
                'categories' => 'Bug',
            ],
            [
                'user_id' => 2,
                'title' => 'Feedback Title 2',
                'text' => 'Some feedback content for the second user.',
                'categories' => 'Bug',
            ],
            // Add more feedback entries as needed
        ]);
    }
}
