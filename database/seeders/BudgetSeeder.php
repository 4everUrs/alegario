<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budgets')->insert([
            [
                'year' => '2022',
                'amount' => '1000000',
                'encoded_by' => 'Administrator',
                'operating' => '0',
                'maintenance' => '0',
                'improvisation' => '0',
                'general' => '0'
            ],
            [
                'year' => '2023',
                'amount' => '2000000',
                'encoded_by' => 'Administrator',
                'operating' => '500000',
                'maintenance' => '500000',
                'improvisation' => '500000',
                'general' => '500000'
            ],

        ]);
    }
}
