<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            'Cisco',
            'Microsoft',
            'AWS',
            'Google Cloud',
            'Fortinet',
            'VMware',
            'Dell',
            'HP',
        ];

        foreach ($vendors as $name) {
            DB::table('vendors')->insert([
                'logo'       => null,
                'name'       => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
