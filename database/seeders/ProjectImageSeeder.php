<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {
        // Set cover images on each project
        $covers = [
            1 => 'luxury-smart-home.png',
            2 => 'enterprise-network-security.png',
            3 => 'ecommerce-platform.png',
            4 => 'healthcare-mobile-app.png',
            5 => 'smart-office-automation.png',
            6 => 'cloud-migration.png',
        ];

        foreach ($covers as $projectId => $filename) {
            DB::table('projects')->where('id', $projectId)->update(['image' => $filename]);
        }

        // Seed gallery images (project_images table)
        // Each project gets 3 gallery images (reusing available images for demo)
        $gallery = [
            1 => ['luxury-smart-home.png', 'smart-office-automation.png', 'enterprise-network-security.png'],
            2 => ['enterprise-network-security.png', 'cloud-migration.png', 'luxury-smart-home.png'],
            3 => ['ecommerce-platform.png', 'healthcare-mobile-app.png', 'cloud-migration.png'],
            4 => ['healthcare-mobile-app.png', 'ecommerce-platform.png', 'smart-office-automation.png'],
            5 => ['smart-office-automation.png', 'luxury-smart-home.png', 'enterprise-network-security.png'],
            6 => ['cloud-migration.png', 'enterprise-network-security.png', 'ecommerce-platform.png'],
        ];

        DB::table('project_images')->delete();

        foreach ($gallery as $projectId => $images) {
            foreach ($images as $sortOrder => $filename) {
                DB::table('project_images')->insert([
                    'project_id' => $projectId,
                    'image'      => $filename,
                    'sort_order' => $sortOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
