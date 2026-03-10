<?php

namespace Modules\SocialMedia\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'platform' => (string) $this->platform,
            'link' => (string) $this->link,
            'logo' => (string) $this->image_path,
        ];
    }
}
