<?php

namespace Modules\Smart\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartFeatureTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'smart_feature_id', 'locale'];
}
