<?php

namespace Modules\Service\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProcessResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $translation = $this->translateOrDefault(locale());

        return [
            'num'         => (string) ($this->num ?? '01'),
            'title'       => (string) ($translation?->title ?? ''),
            'description' => (string) ($translation?->description ?? ''),
        ];
    }
}
