<?php

namespace Modules\Sni\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhyItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'   => (int) $this->id,
            'text' => (string) ($this->translateOrDefault(locale())?->text ?? ''),
        ];
    }
}
