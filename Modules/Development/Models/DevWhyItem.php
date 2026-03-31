<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class DevWhyItem extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['image'];

    public $translatedAttributes = ['title', 'description'];
}
