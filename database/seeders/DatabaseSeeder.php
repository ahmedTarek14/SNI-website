<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            SmartSeeder::class,
            ProjectSeeder::class,
            ImpactNumberSeeder::class,
            FaqSeeder::class,
            ReviewSeeder::class,
            SettingSeeder::class,
            AboutSeeder::class,
            SocialMediaSeeder::class,
            VendorSeeder::class,
            AboutPageSeeder::class,
            WorkHourSeeder::class,
            DevelopmentPageSeeder::class,
        ]);
    }
}
