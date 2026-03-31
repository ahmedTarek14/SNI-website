<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['name'];

    public $translatedAttributes = ['name'];

    public $translationModel = CategoryTranslation::class;
    public $translationForeignKey = 'category_id';

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
