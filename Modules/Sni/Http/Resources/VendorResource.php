<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'logo' => (string) $this->image_path,
            'name' => (string)$this->name,
        ];
    }
}
