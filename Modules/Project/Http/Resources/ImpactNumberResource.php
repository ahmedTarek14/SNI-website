<?php

namespace Modules\Project\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImpactNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'satisfied_clients' => (int) $this->satisfied_clients,
            'completed_projects' => (int) $this->completed_projects,
            'years_of_experience' => (int) $this->years_of_experience,
            'success_rate' => (float) $this->success_rate,
        ];
    }
}
