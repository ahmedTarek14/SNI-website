<?php

namespace Modules\Project\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => (int) $this->id,
            'image'       => (string) $this?->image_path,
            'client'      => (string) $this?->clint,
            'name'        => (string) $this?->translateOrDefault(locale())?->name,
            'description' => (string) $this?->translateOrDefault(locale())?->description,
            'date_at'     => (string) $this?->date_at,
            'category'    => (string) ($this?->category?->translateOrDefault(locale())?->name ?? $this?->category?->name),
        ];
    }
}
