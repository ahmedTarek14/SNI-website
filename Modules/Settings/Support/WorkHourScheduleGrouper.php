<?php

namespace Modules\Settings\Support;

use Modules\Settings\Models\WorkHour;

class WorkHourScheduleGrouper
{
    /**
     * Collapse a set of per-day work hours into consecutive-day ranges
     * (in fixed Saturday→Friday order) sharing the same open_time,
     * close_time and is_off. Pure/stateless: does not read or write the
     * database, so it can be unit tested with plain arrays or models.
     */
    public static function group(iterable $workHours): array
    {
        $order = array_keys(WorkHour::DAYS);
        $byDay = collect($workHours)->keyBy(
            static fn ($workHour) => is_array($workHour) ? $workHour['day_key'] : $workHour->day_key
        );

        $ranges = [];
        $current = null;

        foreach ($order as $dayKey) {
            $workHour = $byDay->get($dayKey);

            if (! $workHour) {
                if ($current !== null) {
                    $ranges[] = $current;
                    $current = null;
                }

                continue;
            }

            $isOff = (bool) (is_array($workHour) ? $workHour['is_off'] : $workHour->is_off);
            $openTime = $isOff ? null : (is_array($workHour) ? $workHour['open_time'] : $workHour->open_time);
            $closeTime = $isOff ? null : (is_array($workHour) ? $workHour['close_time'] : $workHour->close_time);
            $signature = [$openTime, $closeTime, $isOff];

            if ($current !== null && $current['signature'] === $signature) {
                $current['to'] = $dayKey;
            } else {
                if ($current !== null) {
                    $ranges[] = $current;
                }

                $current = ['from' => $dayKey, 'to' => $dayKey, 'signature' => $signature];
            }
        }

        if ($current !== null) {
            $ranges[] = $current;
        }

        return array_map(static function (array $range) {
            [$openTime, $closeTime, $isOff] = $range['signature'];

            return [
                'day_key_from' => $range['from'],
                'day_key_to'   => $range['to'],
                'open_time'    => $openTime,
                'close_time'   => $closeTime,
                'is_off'       => $isOff,
            ];
        }, $ranges);
    }
}
