<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@mail.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@mail.com',
               'type'=> 0,
               'password'=> bcrypt('123456'),
            ],
        ];
        
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
