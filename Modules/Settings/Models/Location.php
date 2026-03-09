<?php

namespace Modules\Settings\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Location extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['lat', 'lng'];

    public $translatedAttributes = ['address'];
}
