<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoreValueResource extends JsonResource
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
