<?php

namespace Modules\Page\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'header' => (string) $this?->translateOrDefault(locale())?->header,
            'subtitle' => (string)  $this?->translateOrDefault(locale())?->subtitle,
        ];
    }
}
