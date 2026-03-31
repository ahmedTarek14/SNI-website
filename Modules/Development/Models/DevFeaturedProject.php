<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class DevFeaturedProject extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['image', 'tech'];

    public $translatedAttributes = ['title', 'description'];
}
