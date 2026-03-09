<?php

namespace Modules\Smart\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use App\Traits\ImageTrait;

class SmartFeature extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['logo'];

    public $translatedAttributes = ['title', 'subtitle'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'smart-features');
    }
}
