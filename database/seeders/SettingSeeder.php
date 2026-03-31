<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            'logo'       => null,
            'email'      => 'sniservices@gmail.com',
            'phone'      => '+1 (903) 567 3690',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $locationId = DB::table('locations')->insertGetId([
            'lat'        => '40.7131',
            'lng'        => '-74.0037',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach (['en', 'ar'] as $locale) {
            DB::table('location_translations')->insert([
                'location_id' => $locationId,
                'locale'      => $locale,
                'address'     => '111 Great Western Street, Queens, NY 75100',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
