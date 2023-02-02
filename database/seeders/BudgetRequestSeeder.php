<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budget_requests')->insert([
            [
                'department' => 'Procurement',
                'requestor' => 'John Doe',
                'description' => 'Purchasing New Equipments',
                'amount' => '25000',
                'status' => 'Pending',


            ],
            [
                'department' => 'Human Resource',
                'requestor' => 'Mark John Baldo',
                'description' => 'Purchasing Weeds',
                'amount' => '1000',
                'status' => 'Pending',
            ],

        ]);
    }
}
