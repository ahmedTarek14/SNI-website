<?php

namespace Modules\Service\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'sub_title' => (string) ($translation?->subtitle ?? null),
            'description' => (string) ($translation?->description ?? null),
            'logo' => (string) $this?->image_path,
        ];
    }
}
