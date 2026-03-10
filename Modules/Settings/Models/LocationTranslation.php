<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'location_id', 'locale'];
}
