<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProcessTranslation extends Model
{
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'locale', 'service_process_id'];
}
