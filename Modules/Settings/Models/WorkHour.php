<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class WorkHour extends Model
{
    use HasFactory, Translatable;

    public const DAYS = [
        'saturday'  => ['en' => 'Saturday',  'ar' => 'السبت'],
        'sunday'    => ['en' => 'Sunday',    'ar' => 'الأحد'],
        'monday'    => ['en' => 'Monday',    'ar' => 'الاثنين'],
        'tuesday'   => ['en' => 'Tuesday',   'ar' => 'الثلاثاء'],
        'wednesday' => ['en' => 'Wednesday', 'ar' => 'الأربعاء'],
        'thursday'  => ['en' => 'Thursday',  'ar' => 'الخميس'],
        'friday'    => ['en' => 'Friday',    'ar' => 'الجمعة'],
    ];

    protected $fillable = ['day_key', 'open_time', 'close_time', 'is_off'];

    public $translatedAttributes = ['day'];
}
