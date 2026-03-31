<?php

namespace Modules\Development\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DevGuaranteeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $translation = $this->translateOrDefault(locale());
        return [
            'id'          => (int) $this->id,
            'icon'        => (string) ($this->icon ?? ''),
            'title'       => (string) ($translation?->title ?? ''),
            'description' => (string) ($translation?->description ?? ''),
        ];
    }
}
