<?php

namespace Modules\Project\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $translation = $this->translateOrDefault(locale());

        return [
            'id'          => (int) $this->id,
            'name'        => (string) ($translation?->name ?? ''),
            'description' => (string) ($translation?->description ?? ''),
            'client'      => (string) ($this->clint ?? ''),
            'date_at'     => (string) ($this->date_at ?? ''),
            'category'    => (string) ($this->category?->translateOrDefault(locale())?->name ?? $this->category?->name ?? ''),
            'cover_image' => $this->image ? (string) $this->image_path : null,
            'images'      => $this->images->map(fn($img) => [
                'id'    => $img->id,
                'image' => $img->image ? (string) $img->image_path : null,
            ])->filter(fn($img) => $img['image'])->values()->toArray(),
        ];
    }
}
