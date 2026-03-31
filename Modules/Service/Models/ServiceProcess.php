<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class ServiceProcess extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['service_id', 'num', 'sort_order'];

    public $translationModel = ServiceProcessTranslation::class;
    public $translationForeignKey = 'service_process_id';
    public $translatedAttributes = ['title', 'description'];
}
