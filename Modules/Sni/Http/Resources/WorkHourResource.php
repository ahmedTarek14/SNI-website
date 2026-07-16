<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Settings\Models\WorkHour;

class WorkHourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = locale();
        $fromKey = $this->resource['day_key_from'];
        $toKey   = $this->resource['day_key_to'];

        $fromLabel = WorkHour::DAYS[$fromKey][$locale] ?? '';
        $toLabel   = WorkHour::DAYS[$toKey][$locale] ?? '';

        $day = $fromKey === $toKey ? $fromLabel : $fromLabel . ' – ' . $toLabel;

        return [
            'day_key_from' => (string) $fromKey,
            'day_key_to'   => (string) $toKey,
            'day'          => (string) $day,
            'open_time'    => $this->resource['open_time'] !== null ? (string) $this->resource['open_time'] : null,
            'close_time'   => $this->resource['close_time'] !== null ? (string) $this->resource['close_time'] : null,
            'is_off'       => (bool) $this->resource['is_off'],
        ];
    }
}
