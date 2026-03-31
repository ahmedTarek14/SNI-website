<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = true;
    protected $fillable = ['name', 'locale', 'category_id'];
}
