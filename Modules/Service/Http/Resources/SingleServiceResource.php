<?php

namespace Modules\Service\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $translation = $this?->translateOrDefault(locale());

        return [
            'id' => (int) $this?->id,
            'title' => (string) ($translation?->title ?? null),
        ];
    }
}
