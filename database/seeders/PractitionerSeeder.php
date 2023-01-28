<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PractitionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('practitioners')->insert([
            [
                'name' => 'Bon Jovi',
                'address' => 'Marawi',
                'phone' => '123-1234',
                'license' => 'abc123-xyz',
            ],
            [
                'name' => 'Ed Sheeran',
                'address' => 'Atlantis',
                'phone' => '123-1234',
                'license' => 'abc123-xyz',
            ],
        ]);
    }
}
