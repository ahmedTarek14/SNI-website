<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        // Note: the 'image' column was dropped from abouts table via migration
        // 2026_03_18_173036_delete_image_from_abouts_table.php
        $aboutId = DB::table('abouts')->insertGetId([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $description = 'At Secure Net Innovation, we are committed to delivering sustainable and comprehensive IT solutions. We strive to empower businesses with cutting-edge technology solutions that drive growth and efficiency. Founded with a vision to bridge the gap between complex technology and business needs, SNI has grown to become a trusted partner for enterprises worldwide.';

        foreach (['en', 'ar'] as $locale) {
            DB::table('about_translations')->insert([
                'about_id'    => $aboutId,
                'locale'      => $locale,
                'title'       => 'About SNI',
                'description' => $description,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
