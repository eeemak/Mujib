<?php

use Illuminate\Database\Seeder;
use App\Model\District;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create([
            'name' => 'Dhaka',
        ]);
        District::create([
            'name' => 'Narayanganj',
        ]);
        District::create([
            'name' => 'Gazipur',
        ]);
    }
}
