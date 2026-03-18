<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SniContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $addresses = $this['addresses'] ?? [];
        $phones = $this['phones'] ?? [];
        $emails = $this['emails'] ?? [];

        return [
            'addresses' => collect($addresses)
                ->filter(fn($item) => !empty($item['address']))
                ->values()
                ->all(),
            'phones' => collect($phones)
                ->filter()
                ->map(static fn($value) => (string) $value)
                ->values()
                ->all(),

            'emails' => collect($emails)
                ->filter()
                ->map(static fn($value) => (string) $value)
                ->values()
                ->all(),
        ];
    }
}
