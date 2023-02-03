<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@alegariocure.hms',
                'username' => 'hrAdmin',
                'password' => Hash::make('admin1234'),
                'user_level' => 0,
                'phone' => '111-3345'
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@alegariocure.hms',
                'username' => 'hrManager',
                'password' => Hash::make('admin1234'),
                'user_level' => 1,
                'phone' => '555-3335'
            ],
        ]);
    }
}
