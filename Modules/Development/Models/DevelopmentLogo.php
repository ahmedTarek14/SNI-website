<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImageTrait;

class DevelopmentLogo extends Model
{
    use HasFactory, ImageTrait;

    protected $fillable = ['logo', 'development_id'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'development');
    }

    public function development()
    {
        return $this->belongsTo(Development::class);
    }
}
