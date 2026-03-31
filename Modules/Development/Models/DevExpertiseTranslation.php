<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevExpertiseTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['dev_expertise_id', 'locale', 'title', 'description', 'bullets'];
}
