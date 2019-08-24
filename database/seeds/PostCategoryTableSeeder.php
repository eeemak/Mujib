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
            ['name'=> 'general','type'=>'general'],
            ['name'=> 'blog','type'=>'blog'],
            ['name'=> 'header_news','type'=>'news'],
            ['name'=> 'header_news_right','type'=>'news'],
            ['name'=> 'header_news_bottom','type'=>'news'],
            ['name'=> 'general_news','type'=>'news'],
            ['name'=> 'world','type'=>'general'],
            ['name'=> 'science','type'=>'general'],
            ['name'=> 'health','type'=>'general'],
            ['name'=> 'sports','type'=>'general'],
         ]);
    }
}
