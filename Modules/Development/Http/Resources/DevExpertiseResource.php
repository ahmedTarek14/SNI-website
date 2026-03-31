<?php

namespace Modules\Development\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DevExpertiseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $translation = $this->translateOrDefault(locale());
        $bullets = json_decode($translation?->bullets ?? '[]', true) ?: [];
        return [
            'id'          => (int) $this->id,
            'image'       => (string) ($this->image ?? ''),
            'title'       => (string) ($translation?->title ?? ''),
            'description' => (string) ($translation?->description ?? ''),
            'bullets'     => $bullets,
        ];
    }
}
