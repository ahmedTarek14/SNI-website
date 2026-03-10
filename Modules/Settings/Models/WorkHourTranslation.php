<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkHourTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'work_hour_id', 'locale'];
}
