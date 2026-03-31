<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Insert categories
        $categoryNames = [
            'Smart Home',
            'IT Solutions',
            'Automation',
            'Security',
            'Cloud',
            'Web Dev',
            'App Dev',
        ];

        $categoryIds = [];
        foreach ($categoryNames as $name) {
            $categoryIds[$name] = DB::table('categories')->insertGetId([
                'name'       => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert projects
        // Note: the projects table uses 'clint' (typo in migration) for the client column
        $projects = [
            [
                'clint'    => 'Apex Residences',
                'date_at'  => 'December 2025',
                'category' => 'Smart Home',
                'name'        => 'Luxury Smart Home Integration',
                'description' => 'Integrated smart home system for a 10,000 sq ft luxury property.',
            ],
            [
                'clint'    => 'GlobalTech Inc.',
                'date_at'  => 'November 2025',
                'category' => 'IT Solutions',
                'name'        => 'Enterprise Network Security',
                'description' => 'Implemented robust network security protocols across multiple locations.',
            ],
            [
                'clint'    => 'StyleCart Online',
                'date_at'  => 'October 2025',
                'category' => 'Web Dev',
                'name'        => 'E-commerce Platform',
                'description' => 'Developed a scalable e-commerce platform with seamless payment gateways.',
            ],
            [
                'clint'    => 'VitalHealth Solutions',
                'date_at'  => 'September 2025',
                'category' => 'App Dev',
                'name'        => 'Healthcare Mobile App',
                'description' => 'Created a patient-centric mobile application for appointment booking and health records.',
            ],
            [
                'clint'    => 'Innovate Corp.',
                'date_at'  => 'August 2025',
                'category' => 'Automation',
                'name'        => 'Smart Office Automation',
                'description' => 'Implemented intelligent automation for enhanced office efficiency.',
            ],
            [
                'clint'    => 'DataStream Logistics',
                'date_at'  => 'July 2025',
                'category' => 'Cloud',
                'name'        => 'Cloud Migration Project',
                'description' => 'Seamless migration of legacy systems to a secure cloud infrastructure.',
            ],
        ];

        foreach ($projects as $projectData) {
            $projectId = DB::table('projects')->insertGetId([
                'image'       => null,
                'clint'       => $projectData['clint'],
                'date_at'     => $projectData['date_at'],
                'category_id' => $categoryIds[$projectData['category']],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            foreach (['en', 'ar'] as $locale) {
                DB::table('project_translations')->insert([
                    'project_id'  => $projectId,
                    'locale'      => $locale,
                    'name'        => $projectData['name'],
                    'description' => $projectData['description'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        // Insert challenges
        // Note: challenges table has 'image', 'name', 'company' columns
        // Translatable fields go in challenge_translations: title, challenge, solution, result, description
        $challenges = [
            [
                'title'       => 'Luxury Smart Home Integration',
                'challenge'   => 'Integrating complex systems into a large property',
                'solution'    => 'Custom smart home architecture',
                'result'      => '40% energy savings, 99.9% uptime',
                'description' => 'SNI transformed our home experience with seamless automation.',
            ],
            [
                'title'       => 'Enterprise Network Security',
                'challenge'   => 'Securing a global network against cyber threats.',
                'solution'    => 'Multi-layered security implementation',
                'result'      => 'Zero breaches, 500+ devices secured',
                'description' => 'Our network is now impenetrable thanks to SNI expertise.',
            ],
            [
                'title'       => 'E-commerce Platform',
                'challenge'   => 'Building a high-traffic online store.',
                'solution'    => 'Scalable cloud-based platform.',
                'result'      => '300% sales increase, 50K users',
                'description' => 'Our online sales have skyrocketed since launching the new platform.',
            ],
        ];

        foreach ($challenges as $challengeData) {
            $challengeId = DB::table('challenges')->insertGetId([
                'image'      => null,
                'name'       => null,
                'company'    => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (['en', 'ar'] as $locale) {
                DB::table('challenge_translations')->insert([
                    'challenge_id' => $challengeId,
                    'locale'       => $locale,
                    'title'        => $challengeData['title'],
                    'challenge'    => $challengeData['challenge'],
                    'solution'     => $challengeData['solution'],
                    'result'       => $challengeData['result'],
                    'description'  => $challengeData['description'],
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}
