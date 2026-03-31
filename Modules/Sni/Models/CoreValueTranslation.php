<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoreValueTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['core_value_id', 'locale', 'title', 'description'];
}
