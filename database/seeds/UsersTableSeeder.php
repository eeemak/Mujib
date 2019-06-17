<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\User::create([
            'email' => "admin@example.com",
            'name' => "Admin",
            'username' => "admin",
            'password' => bcrypt("admin"),
        ]);

    	App\User::create([
            'email' => "user@example.com",
            'name' => "User",
            'username' => "user",
            'password' => bcrypt("user"),
        ]);
    }
}
