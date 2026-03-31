<?php

namespace Modules\Project\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'   => (int) $this?->id,
            'name' => (string) ($this?->translateOrDefault(locale())?->name ?? $this?->name),
        ];
    }
}
