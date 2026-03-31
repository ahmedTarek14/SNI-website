<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class DevGuarantee extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['icon'];

    public $translatedAttributes = ['title', 'description'];
}
