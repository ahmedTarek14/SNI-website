<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use App\Traits\ImageTrait;

class Challenge extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['image', 'name', 'company'];

    public $translatedAttributes = ['title', 'challenge', 'solution', 'result', 'description'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->image, 'challenges');
    }
}
