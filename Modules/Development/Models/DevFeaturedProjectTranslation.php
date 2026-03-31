<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevFeaturedProjectTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['dev_featured_project_id', 'locale', 'title', 'description'];
}
