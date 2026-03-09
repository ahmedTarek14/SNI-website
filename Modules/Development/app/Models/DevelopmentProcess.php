<?php

namespace Modules\Development\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class DevelopmentProcess extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['logo'];

    public $translatedAttributes = ['title', 'subtitle'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'development-process');
    }
}
