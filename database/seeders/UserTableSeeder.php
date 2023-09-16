<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
        [
            'name'           => 'Super Admin',
            'username'       => 'supperadmin',
            'phone_no'       => '078343143',
            'email'          => 'superadmin@login.com',
            'password'       => bcrypt('11223344'),
            'remember_token' => null,
        ],
    ];

    User::insert($users);
    }
}
