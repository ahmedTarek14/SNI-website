<?php

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['header', 'subtitle', 'banner_id', 'locale'];
}
