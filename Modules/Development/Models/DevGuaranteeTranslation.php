<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevGuaranteeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['dev_guarantee_id', 'locale', 'title', 'description'];
}
