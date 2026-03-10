<?php

namespace Modules\Smart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartBenefitTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'smart_benefit_id', 'locale'];
}
