<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name'=>'admin', 'guard_name'=>'web']);
        DB::table('roles')->insert(['name'=>'user', 'guard_name'=>'web']);
        App\User::find(1)->assignRole('admin');
        App\User::find(2)->assignRole('user');
    }
}
