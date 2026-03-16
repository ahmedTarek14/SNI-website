<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImageTrait;
use Astrotomic\Translatable\Translatable;

class Vendor extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['logo', 'name'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'vendors');
    }
}
