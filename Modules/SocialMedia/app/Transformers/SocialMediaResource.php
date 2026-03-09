<?php

namespace Modules\SocialMedia\Transformers;

use Illuminate\Http\Request;
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
            'icon' => (string) $this->image,
        ];
    }
}
