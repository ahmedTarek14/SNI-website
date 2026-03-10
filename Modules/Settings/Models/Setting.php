<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImageTrait;

class Setting extends Model
{
    use HasFactory, ImageTrait;

    protected $fillable = ['logo', 'email', 'phone'];

    public $translatedAttributes = [];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'settings');
    }
}
