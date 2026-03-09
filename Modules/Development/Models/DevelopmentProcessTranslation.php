<?php

namespace Modules\Development\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevelopmentProcessTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'development_process_id', 'locale'];
}
