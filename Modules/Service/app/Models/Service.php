<?php

namespace Modules\Service\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use App\Traits\ImageTrait;

class Service extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['logo'];

    public $translatedAttributes = ['title', 'subtitle', 'description'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'services');
    }
}
