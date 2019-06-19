<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
            'email' => "admin@example.com",
            'full_name' => "Admin",
            'username' => "admin",
            'password' => bcrypt("admin"),
        ]);

    	User::create([
            'email' => "user@example.com",
            'full_name' => "User",
            'username' => "user",
            'password' => bcrypt("user"),
        ]);
    }
}
