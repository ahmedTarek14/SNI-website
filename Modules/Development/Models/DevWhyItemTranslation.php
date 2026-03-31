<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevWhyItemTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['dev_why_item_id', 'locale', 'title', 'description'];
}
