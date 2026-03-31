<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmartSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            [
                'title'    => 'Smart Lighting',
                'subtitle' => 'Control lighting with voice commands and automated schedules.',
            ],
            [
                'title'    => 'Security Systems',
                'subtitle' => 'Advanced security with cameras, motion sensors, and smart locks.',
            ],
            [
                'title'    => 'Climate Control',
                'subtitle' => 'Smart thermostats for optimal comfort and energy efficiency.',
            ],
            [
                'title'    => 'Entertainment',
                'subtitle' => 'Integrated audio/video systems for immersive home entertainment.',
            ],
            [
                'title'    => 'Automation',
                'subtitle' => 'Automate routines, daily tasks, and appliance operations.',
            ],
            [
                'title'    => 'Energy Management',
                'subtitle' => 'Monitor and optimize energy consumption for cost savings.',
            ],
        ];

        foreach ($features as $featureData) {
            $featureId = DB::table('smart_features')->insertGetId([
                'logo'       => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (['en', 'ar'] as $locale) {
                DB::table('smart_feature_translations')->insert([
                    'smart_feature_id' => $featureId,
                    'locale'           => $locale,
                    'title'            => $featureData['title'],
                    'subtitle'         => $featureData['subtitle'],
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }

        $benefits = [
            [
                'title'    => 'Convenience',
                'subtitle' => 'Effortless control over your home environment from anywhere, anytime.',
            ],
            [
                'title'    => 'Security',
                'subtitle' => 'Enhanced peace of mind with 24/7 monitoring and intelligent access control.',
            ],
            [
                'title'    => 'Efficiency',
                'subtitle' => 'Optimize energy usage, reduce utility bills, and contribute to a greener planet.',
            ],
        ];

        foreach ($benefits as $benefitData) {
            $benefitId = DB::table('smart_benefits')->insertGetId([
                'logo'       => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (['en', 'ar'] as $locale) {
                DB::table('smart_benefit_translations')->insert([
                    'smart_benefit_id' => $benefitId,
                    'locale'           => $locale,
                    'title'            => $benefitData['title'],
                    'subtitle'         => $benefitData['subtitle'],
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }
    }
}
