<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'name'    => (string) $this->name,
            'rate'    => (string) $this->rate,
            'message' => (string) ($this->translateOrDefault(locale())?->message ?? $this->message),
        ];
    }
}
