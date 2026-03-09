<?php

namespace Modules\Settings\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class WorkHour extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['open_time', 'close_time', 'is_off'];

    public $translatedAttributes = ['day'];
}
