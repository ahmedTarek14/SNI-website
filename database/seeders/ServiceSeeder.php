<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Enterprise Security',
                'subtitle'    => 'Multi-layered cybersecurity built to stop modern threats.',
                'description' => 'Comprehensive threat detection, firewall management, and end-to-end security solutions for modern enterprises.',
            ],
            [
                'title'       => 'Network Infrastructure',
                'subtitle'    => 'High-performance, resilient networks engineered to scale.',
                'description' => 'Scalable, high-performance network design and deployment built to support your growing operations.',
            ],
            [
                'title'       => 'Cloud Solutions',
                'subtitle'    => 'Migrate, scale, and optimize your cloud infrastructure.',
                'description' => 'Private and public cloud migration, automation, and management to keep your business agile.',
            ],
            [
                'title'       => 'IT Consulting',
                'subtitle'    => 'Strategic technology guidance aligned with business growth.',
                'description' => 'Strategic technology roadmaps and digital transformation guidance tailored to your business goals.',
            ],
            [
                'title'       => 'Data Management',
                'subtitle'    => 'Turn raw data into reliable intelligence.',
                'description' => 'Analytics, governance, and BI solutions that transform your data into a strategic asset.',
            ],
            [
                'title'       => 'Smart Home Integration',
                'subtitle'    => 'Every device, perfectly connected.',
                'description' => 'Smart lighting, climate, security, and entertainment systems — fully integrated and voice-controlled.',
            ],
        ];

        foreach ($services as $serviceData) {
            $serviceId = DB::table('services')->insertGetId([
                'logo'       => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (['en', 'ar'] as $locale) {
                DB::table('service_translations')->insert([
                    'service_id'  => $serviceId,
                    'locale'      => $locale,
                    'title'       => $serviceData['title'],
                    'subtitle'    => $serviceData['subtitle'],
                    'description' => $serviceData['description'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
