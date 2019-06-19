<?php

use Illuminate\Database\Seeder;

class VillageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PoliceStation::create(['id'=>'2','district_id'=>'','thana_id'=>'','police_stations_id'=>'','name' => '']);
    }
}
