<?php

namespace Modules\Development\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevTechnology extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
