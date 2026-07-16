<?php

use Modules\Settings\Support\WorkHourScheduleGrouper;

function makeWorkHour(string $dayKey, ?string $openTime, ?string $closeTime, bool $isOff): array
{
    return [
        'day_key'    => $dayKey,
        'open_time'  => $openTime,
        'close_time' => $closeTime,
        'is_off'     => $isOff,
    ];
}

test('groups consecutive days sharing the same schedule', function () {
    $result = WorkHourScheduleGrouper::group([
        makeWorkHour('saturday', '10:00:00', '16:00:00', false),
        makeWorkHour('sunday', null, null, true),
        makeWorkHour('monday', '09:00:00', '18:00:00', false),
        makeWorkHour('tuesday', '09:00:00', '18:00:00', false),
        makeWorkHour('wednesday', '09:00:00', '18:00:00', false),
        makeWorkHour('thursday', '09:00:00', '18:00:00', false),
        makeWorkHour('friday', '09:00:00', '18:00:00', false),
    ]);

    expect($result)->toBe([
        ['day_key_from' => 'saturday', 'day_key_to' => 'saturday', 'open_time' => '10:00:00', 'close_time' => '16:00:00', 'is_off' => false],
        ['day_key_from' => 'sunday', 'day_key_to' => 'sunday', 'open_time' => null, 'close_time' => null, 'is_off' => true],
        ['day_key_from' => 'monday', 'day_key_to' => 'friday', 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
    ]);
});

test('does not merge matching days that are not consecutive', function () {
    $result = WorkHourScheduleGrouper::group([
        makeWorkHour('saturday', '09:00:00', '18:00:00', false),
        makeWorkHour('sunday', null, null, true),
        makeWorkHour('monday', '09:00:00', '18:00:00', false),
    ]);

    expect($result)->toBe([
        ['day_key_from' => 'saturday', 'day_key_to' => 'saturday', 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
        ['day_key_from' => 'sunday', 'day_key_to' => 'sunday', 'open_time' => null, 'close_time' => null, 'is_off' => true],
        ['day_key_from' => 'monday', 'day_key_to' => 'monday', 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_off' => false],
    ]);
});

test('nulls open and close time for off days even when raw stored values differ', function () {
    $result = WorkHourScheduleGrouper::group([
        makeWorkHour('sunday', '00:00:00', '00:00:00', true),
        makeWorkHour('monday', '05:00:00', '05:00:00', true),
    ]);

    expect($result)->toBe([
        ['day_key_from' => 'sunday', 'day_key_to' => 'monday', 'open_time' => null, 'close_time' => null, 'is_off' => true],
    ]);
});

test('groups all seven days into a single range when the whole week matches', function () {
    $days = array_keys(\Modules\Settings\Models\WorkHour::DAYS);
    $result = WorkHourScheduleGrouper::group(
        array_map(fn ($day) => makeWorkHour($day, '09:00:00', '17:00:00', false), $days)
    );

    expect($result)->toBe([
        ['day_key_from' => 'saturday', 'day_key_to' => 'friday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_off' => false],
    ]);
});

test('ignores missing days without breaking adjacency of the ones present', function () {
    $result = WorkHourScheduleGrouper::group([
        makeWorkHour('saturday', '09:00:00', '17:00:00', false),
        makeWorkHour('monday', '09:00:00', '17:00:00', false),
    ]);

    expect($result)->toBe([
        ['day_key_from' => 'saturday', 'day_key_to' => 'saturday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_off' => false],
        ['day_key_from' => 'monday', 'day_key_to' => 'monday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_off' => false],
    ]);
});
