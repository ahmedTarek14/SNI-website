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
            'title' => (string) ($translation?->title ?? ''),
            'sub_title' => (string) ($translation?->subtitle ?? ''),
            'logo' => (string) $this?->image_path,
        ];
    }
}
