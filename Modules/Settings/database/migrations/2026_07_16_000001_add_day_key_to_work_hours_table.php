<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $canonicalDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

    private array $dayLabels = [
        'saturday'  => ['en' => 'Saturday',  'ar' => 'السبت'],
        'sunday'    => ['en' => 'Sunday',    'ar' => 'الأحد'],
        'monday'    => ['en' => 'Monday',    'ar' => 'الاثنين'],
        'tuesday'   => ['en' => 'Tuesday',   'ar' => 'الثلاثاء'],
        'wednesday' => ['en' => 'Wednesday', 'ar' => 'الأربعاء'],
        'thursday'  => ['en' => 'Thursday',  'ar' => 'الخميس'],
        'friday'    => ['en' => 'Friday',    'ar' => 'الجمعة'],
    ];

    public function up(): void
    {
        Schema::table('work_hours', function (Blueprint $table) {
            $table->string('day_key')->nullable()->after('is_off');
        });

        $this->backfillDayKeys();

        Schema::table('work_hours', function (Blueprint $table) {
            $table->unique('day_key');
        });
    }

    public function down(): void
    {
        Schema::table('work_hours', function (Blueprint $table) {
            $table->dropUnique(['work_hours_day_key_unique']);
            $table->dropColumn('day_key');
        });
    }

    // Existing rows may store free-text day labels, including "Day1 – Day2" ranges
    // (e.g. "Monday – Friday"); those ranges are expanded into one row per real day
    // so day_key can be a fixed, unique weekday enum going forward.
    private function backfillDayKeys(): void
    {
        $rows = DB::table('work_hours')
            ->select('work_hours.id', 'work_hour_translations.day')
            ->leftJoin('work_hour_translations', function ($join) {
                $join->on('work_hour_translations.work_hour_id', '=', 'work_hours.id')
                    ->where('work_hour_translations.locale', '=', 'en');
            })
            ->get();

        foreach ($rows as $row) {
            $text = str_replace(['–', '—'], '-', strtolower(trim((string) $row->day)));

            if (in_array($text, $this->canonicalDays, true)) {
                $this->assignDayKey((int) $row->id, $text);
                continue;
            }

            $parts = array_map('trim', explode('-', $text));
            if (count($parts) === 2 && in_array($parts[0], $this->canonicalDays, true) && in_array($parts[1], $this->canonicalDays, true)) {
                $range = $this->expandRange($parts[0], $parts[1]);
                $original = DB::table('work_hours')->find($row->id);

                $this->assignDayKey((int) $row->id, array_shift($range));

                foreach ($range as $day) {
                    $newId = DB::table('work_hours')->insertGetId([
                        'open_time'  => $original->open_time,
                        'close_time' => $original->close_time,
                        'is_off'     => $original->is_off,
                        'day_key'    => $day,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    foreach ($this->dayLabels[$day] as $locale => $label) {
                        DB::table('work_hour_translations')->insert([
                            'work_hour_id' => $newId,
                            'locale'       => $locale,
                            'day'          => $label,
                            'created_at'   => now(),
                            'updated_at'   => now(),
                        ]);
                    }
                }
            }
        }
    }

    private function assignDayKey(int $id, string $day): void
    {
        DB::table('work_hours')->where('id', $id)->update(['day_key' => $day]);

        foreach ($this->dayLabels[$day] as $locale => $label) {
            DB::table('work_hour_translations')->updateOrInsert(
                ['work_hour_id' => $id, 'locale' => $locale],
                ['day' => $label, 'updated_at' => now()]
            );
        }
    }

    private function expandRange(string $from, string $to): array
    {
        $fromIndex = array_search($from, $this->canonicalDays, true);
        $toIndex   = array_search($to, $this->canonicalDays, true);
        $count     = count($this->canonicalDays);

        $days = [];
        $i = $fromIndex;
        while (true) {
            $days[] = $this->canonicalDays[$i];
            if ($i === $toIndex) {
                break;
            }
            $i = ($i + 1) % $count;
        }

        return $days;
    }
};
