<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
        [
            'username'=>'Admin User',
            'email'=>'admin@itsolutionstuff.com',
            'type'=>'admin',
            'password'=> '12345678',
         ],
         [
            'username'=>'User',
            'email'=>'user@itsolutionstuff.com',
            'type'=>'user',
            'password'=> '12345678',
         ],
        ];

        foreach($users as $key => $user){
            User::create($user);
        }
    }
}
