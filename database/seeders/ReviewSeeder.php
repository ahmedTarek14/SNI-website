<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'name'    => 'John D.',
                'rate'    => '5',
                'message' => 'SNI smart home system transformed our living experience. The integration is seamless, and the support is exceptional.',
            ],
            [
                'name'    => 'Sarah M.',
                'rate'    => '5',
                'message' => 'We feel much more secure and comfortable in our home thanks to SNI advanced solutions.',
            ],
            [
                'name'    => 'Michael R.',
                'rate'    => '5',
                'message' => 'The energy savings and convenience have exceeded our expectations. SNI truly understands smart home technology.',
            ],
            [
                'name'    => 'Sarah Johnson',
                'rate'    => '5',
                'message' => 'The team at SNI is exceptional! Their project delivery is flawless.',
            ],
            [
                'name'    => 'David Lee',
                'rate'    => '5',
                'message' => 'We rely on SNI for all our security needs. Highly recommended.',
            ],
            [
                'name'    => 'Emily Davis',
                'rate'    => '5',
                'message' => 'Their innovative solutions have optimized our operations significantly.',
            ],
        ];

        foreach ($reviews as $review) {
            DB::table('reviews')->insert([
                'name'       => $review['name'],
                'rate'       => $review['rate'],
                'message'    => $review['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
