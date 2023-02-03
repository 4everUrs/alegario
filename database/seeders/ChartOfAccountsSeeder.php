<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartOfAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('charts')->insert([
            [
                'type' => 'Asset',
                'name' => 'Accounts Recievable',
                'balance' => '0',
            ],
            [
                'type' => 'Liabilities',
                'name' => 'Accounts Payable',
                'balance' => '0',
            ],
            [
                'type' => 'Asset',
                'name' => 'Cash',
                'balance' => '0',
            ],
            [
                'type' => 'Revenue',
                'name' => 'Sales',
                'balance' => '0',
            ],
            [
                'type' => 'Equity',
                'name' => 'Alegario Cure CEO',
                'balance' => '0',
            ],
            [
                'type' => 'Expenses',
                'name' => 'General Expenses',
                'balance' => '0',
            ],
        ]);
    }
}
