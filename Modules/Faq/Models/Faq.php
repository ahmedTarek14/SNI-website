<?php

namespace Modules\Faq\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Faq extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [];

    public $translatedAttributes = ['question', 'answer'];
}
