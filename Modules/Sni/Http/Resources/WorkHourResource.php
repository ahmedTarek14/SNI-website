<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkHourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'day'        => (string) ($this->translateOrDefault(locale())?->day ?? ''),
            'open_time'  => (string) ($this->open_time ?? ''),
            'close_time' => (string) ($this->close_time ?? ''),
            'is_off'     => (bool) $this->is_off,
        ];
    }
}
