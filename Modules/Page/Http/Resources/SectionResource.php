<?php

namespace Modules\Page\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => (string) $this?->translateOrDefault(locale())?->title,
            'subtitle' => (string) $this?->translateOrDefault(locale())?->subtitle ?? null,
        ];
    }
}
