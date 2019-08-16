<?php

use Illuminate\Database\Seeder;
use App\Model\PostCategory;


class PostCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCategory::insert([
            ['name'=> 'general'],
            ['name'=> 'header_news'],
            ['name'=> 'header_news_right'],
            ['name'=> 'header_news_bottom'],
            ['name'=> 'world'],
            ['name'=> 'science'],
            ['name'=> 'health'],
            ['name'=> 'sports'],
         ]);
    }
}
