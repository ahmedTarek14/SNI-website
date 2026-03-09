<?php

namespace Modules\Project\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'project_id', 'locale'];
}
