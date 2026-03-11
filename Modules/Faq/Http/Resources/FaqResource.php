<?php

namespace Modules\Faq\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'question' => (string) $this->translateOrDefault(locale())->question,
            'answer' => (string) $this->translateOrDefault(locale())->answer,
        ];
    }
}
