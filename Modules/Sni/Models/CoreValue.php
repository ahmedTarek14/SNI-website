<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class CoreValue extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['icon'];

    public $translatedAttributes = ['title', 'description'];
}
