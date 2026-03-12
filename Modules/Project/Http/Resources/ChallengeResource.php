<?php

namespace Modules\Project\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => (string) $this?->translateOrDefault(locale())?->title,
            'challenge' => (string) $this?->translateOrDefault(locale())?->challenge,
            'solution' => (string) $this?->translateOrDefault(locale())?->solution,
            'result' => (string) $this?->translateOrDefault(locale())?->result,
            'description' => (string) $this?->translateOrDefault(locale())?->description,
            'image' => (string) $this?->image_path,
        ];
    }
}
