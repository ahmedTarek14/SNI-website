<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use App\Traits\ImageTrait;

class Project extends Model
{
    use HasFactory, Translatable, ImageTrait;

    protected $fillable = ['image', 'clint', 'date_at', 'development_id'];

    public $translatedAttributes = ['name', 'description'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->image, 'projects');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
