<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkHourSeeder extends Seeder
{
    public function run(): void
    {
        $hours = [
            // Monday–Friday
            [
                'open_time'  => '09:00:00',
                'close_time' => '18:00:00',
                'is_off'     => false,
                'en'         => 'Monday – Friday',
                'ar'         => 'الاثنين – الجمعة',
            ],
            // Saturday
            [
                'open_time'  => '10:00:00',
                'close_time' => '16:00:00',
                'is_off'     => false,
                'en'         => 'Saturday',
                'ar'         => 'السبت',
            ],
            // Sunday
            [
                'open_time'  => '00:00:00',
                'close_time' => '00:00:00',
                'is_off'     => true,
                'en'         => 'Sunday',
                'ar'         => 'الأحد',
            ],
        ];

        foreach ($hours as $hour) {
            $id = DB::table('work_hours')->insertGetId([
                'open_time'  => $hour['open_time'],
                'close_time' => $hour['close_time'],
                'is_off'     => $hour['is_off'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('work_hour_translations')->insert([
                    'work_hour_id' => $id,
                    'locale'       => $locale,
                    'day'          => $hour[$locale],
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}
