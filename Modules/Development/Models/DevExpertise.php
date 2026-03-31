<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class DevExpertise extends Model
{
    use HasFactory, Translatable;

    protected $table = 'dev_expertise';

    protected $fillable = ['image'];

    public $translatedAttributes = ['title', 'description', 'bullets'];
}
