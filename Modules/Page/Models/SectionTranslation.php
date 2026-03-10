<?php

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'section_id', 'locale'];
}
