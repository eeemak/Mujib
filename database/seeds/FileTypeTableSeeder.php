<?php

use Illuminate\Database\Seeder;
use App\Model\FileType;

class FileTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileType::insert([
           ['fileTypeName'=> 'Pdf'],
           ['fileTypeName'=> 'Image']
        ]);
    }
}
