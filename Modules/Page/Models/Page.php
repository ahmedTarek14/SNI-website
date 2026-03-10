<?php

namespace Modules\Page\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['slug', 'template'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'template',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
