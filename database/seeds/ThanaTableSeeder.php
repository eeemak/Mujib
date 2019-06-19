<?php

use Illuminate\Database\Seeder;
use App\Model\Thana;

class ThanaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thana::create([
            'name' => 'Mirpur',
            'district_id' => '1',
        ]);
        Thana::create([
            'name' => 'Dhanmondi',
            'district_id' => '1',
        ]);
        Thana::create([
            'name' => 'Sonargaon',
            'district_id' => '2',
        ]);
        Thana::create([
            'name' => 'Siddirganj',
            'district_id' => '2',
        ]);
        Thana::create([
            'name' => 'Gazipur Thana',
            'district_id' => '3',
        ]);
    }
}
