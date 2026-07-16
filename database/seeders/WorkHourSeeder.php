<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Models\WorkHour;

class WorkHourSeeder extends Seeder
{
    public function run(): void
    {
        $hours = [
            'saturday'  => ['open_time' => '10:00:00', 'close_time' => '16:00:00', 'is_off' => false],
            'sunday'    => ['open_time' => '00:00:00', 'close_time' => '00:00:00', 'is_off' => true],
            'monday'    => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
            'tuesday'   => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
            'wednesday' => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
            'thursday'  => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
            'friday'    => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
        ];

        foreach ($hours as $dayKey => $hour) {
            $id = DB::table('work_hours')->insertGetId([
                'day_key'    => $dayKey,
                'open_time'  => $hour['open_time'],
                'close_time' => $hour['close_time'],
                'is_off'     => $hour['is_off'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (WorkHour::DAYS[$dayKey] as $locale => $label) {
                DB::table('work_hour_translations')->insert([
                    'work_hour_id' => $id,
                    'locale'       => $locale,
                    'day'          => $label,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}
