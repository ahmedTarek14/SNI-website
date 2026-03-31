<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFeatureTranslation extends Model
{
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'locale', 'service_feature_id'];
}
