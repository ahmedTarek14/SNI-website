<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'description', 'service_id', 'locale'];
}
