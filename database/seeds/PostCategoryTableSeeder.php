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
            ['name'=> 'dhaka']
         ]);
    }
}
