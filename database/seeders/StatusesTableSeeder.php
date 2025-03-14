<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            ['Status_Name' => 'Pending'],
            ['Status_Name' => 'Received by Office'],
            ['Status_Name' => 'Approved by Office'],
        ]);
    }
}
