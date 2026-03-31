<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;

class ProjectImage extends Model
{
    use ImageTrait;

    protected $fillable = ['project_id', 'image', 'sort_order'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->image, 'projects');
    }
}
