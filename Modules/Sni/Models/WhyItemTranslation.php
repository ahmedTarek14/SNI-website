<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhyItemTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['why_item_id', 'locale', 'text'];
}
