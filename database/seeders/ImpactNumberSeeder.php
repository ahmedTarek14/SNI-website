<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImpactNumberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('impact_numbers')->insert([
            'satisfied_clients'   => '200',
            'completed_projects'  => '500',
            'years_of_experience' => '8',
            'success_rate'        => '99.9',
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);
    }
}
