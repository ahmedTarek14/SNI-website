<?php

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Banner extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['page_id'];

    public $translatedAttributes = ['header', 'subtitle'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
