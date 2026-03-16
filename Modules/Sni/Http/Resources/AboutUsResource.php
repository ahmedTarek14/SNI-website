<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $translation = $this?->translateOrDefault(locale());

        return [
            'image' => (string) $this?->image_path,
            'title' => (string) ($translation?->title ?? ''),
            'description' => (string) ($translation?->description ?? ''),
        ];
    }
}
