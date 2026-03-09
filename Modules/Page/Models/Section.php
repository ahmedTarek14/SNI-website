<?php

namespace Modules\Page\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Section extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['page_id'];

    public $translatedAttributes = ['title', 'subtitle'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
