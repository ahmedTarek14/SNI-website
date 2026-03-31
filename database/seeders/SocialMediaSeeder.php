<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $socialMedias = [
            [
                'platform' => 'LinkedIn',
                'link'     => 'https://linkedin.com',
            ],
            [
                'platform' => 'Facebook',
                'link'     => 'https://facebook.com',
            ],
            [
                'platform' => 'Instagram',
                'link'     => 'https://instagram.com',
            ],
        ];

        foreach ($socialMedias as $socialMedia) {
            DB::table('social_medias')->insert([
                'platform'   => $socialMedia['platform'],
                'logo'       => null,
                'link'       => $socialMedia['link'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
