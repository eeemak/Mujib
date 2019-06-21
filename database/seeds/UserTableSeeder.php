<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\UserInstitutions;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id' => "1",
                'email' => "admin@example.com",
                'full_name' => "Admin",
                'username' => "admin",
                'password' => bcrypt("admin"),
            ],
            [
                'id' => "2",
                'email' => "user@example.com",
                'full_name' => "User",
                'username' => "user",
                'password' => bcrypt("user"),
            ]
        ]);
        UserInstitutions::insert([
            [
                'instituteName' => 'Admin Institute',
                'position' => 'Administrator',
                'user_id' => '1',
                'ProfessionTypeId' => '1',
                'Address' => 'Dhaka, Bangladesh',
            ],
            [
                'instituteName' => 'User Institute',
                'position' => 'Mew User',
                'user_id' => '2',
                'ProfessionTypeId' => '2',
                'Address' => 'Dhaka, Bangladesh',
            ]
        ]);
    }
}
