<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImageTrait;
use Astrotomic\Translatable\Translatable;

class About extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['image'];

    public $translatedAttributes = ['title', 'description'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->image, 'abouts');
    }
}
