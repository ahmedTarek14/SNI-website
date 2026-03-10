<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevelopmentTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'description', 'development_id', 'locale'];
}
