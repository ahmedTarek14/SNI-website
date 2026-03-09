<?php

namespace Modules\Page\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'template'];

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
