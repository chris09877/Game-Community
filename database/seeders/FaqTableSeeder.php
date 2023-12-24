<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bugCategoryId = Category::where('name', 'Bug')->value('id');
        $updateCategoryId = Category::where('name', 'Update')->value('id');
        DB::table('faq')->insert([
            [
                'user_id' => 1,
                'title' => 'Feedback Title 1',
                'text' => 'Some feedback content for the first user.',
                'category_id' => $bugCategoryId,
            ],
            [
                'user_id' => 2,
                'title' => 'Feedback Title 2',
                'text' => 'Some feedback content for the second user.',
                'category_id' => $updateCategoryId,
            ],
            // Add more feedback entries as needed
        ]);
    }
}
