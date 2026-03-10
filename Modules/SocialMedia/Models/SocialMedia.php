<?php

namespace Modules\SocialMedia\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImageTrait;

class SocialMedia extends Model
{
    use HasFactory, ImageTrait;

    protected $fillable = ['platform', 'logo', 'link'];

    protected $table = 'social_medias';

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'social-media');
    }
}
