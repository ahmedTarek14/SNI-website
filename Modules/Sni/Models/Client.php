<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImageTrait;

class Client extends Model
{
    use HasFactory, ImageTrait;

    protected $fillable = ['logo', 'name'];

    public function getImagePathAttribute()
    {
        return $this->get_image($this->logo, 'clients');
    }
}
