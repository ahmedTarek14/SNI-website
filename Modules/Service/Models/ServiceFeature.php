<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class ServiceFeature extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['service_id', 'icon', 'sort_order'];

    public $translationModel = ServiceFeatureTranslation::class;
    public $translationForeignKey = 'service_feature_id';
    public $translatedAttributes = ['title', 'description'];
}
