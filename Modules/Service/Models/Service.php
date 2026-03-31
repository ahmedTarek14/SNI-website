<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use App\Traits\ImageTrait;

class Service extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['logo', 'slug'];

    public $translatedAttributes = ['title', 'subtitle', 'description'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'services');
    }

    public function features()
    {
        return $this->hasMany(ServiceFeature::class);
    }

    public function processes()
    {
        return $this->hasMany(ServiceProcess::class);
    }
}
