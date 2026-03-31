<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Review extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['name', 'rate', 'message'];

    public $translatedAttributes = ['message'];

    public $translationModel = ReviewTranslation::class;
    public $translationForeignKey = 'review_id';
}
