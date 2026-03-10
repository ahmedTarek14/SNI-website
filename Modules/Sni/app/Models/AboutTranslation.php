<?php

namespace Modules\Sni\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'about_id', 'locale'];
}
