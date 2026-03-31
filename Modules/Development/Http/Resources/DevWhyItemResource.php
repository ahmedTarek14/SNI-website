<?php

namespace Modules\Development\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DevWhyItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $translation = $this->translateOrDefault(locale());
        return [
            'id'          => (int) $this->id,
            'image'       => (string) ($this->image ?? ''),
            'title'       => (string) ($translation?->title ?? ''),
            'description' => (string) ($translation?->description ?? ''),
        ];
    }
}
