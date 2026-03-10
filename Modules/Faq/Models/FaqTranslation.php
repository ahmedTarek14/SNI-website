<?php

namespace Modules\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'faq_id', 'locale'];
}
