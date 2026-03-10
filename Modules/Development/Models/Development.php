<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use App\Traits\ImageTrait;

class Development extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['logo'];

    public $translatedAttributes = ['title', 'subtitle', 'description'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'development');
    }

    public function logos()
    {
        return $this->hasMany(DevelopmentLogo::class);
    }
}
