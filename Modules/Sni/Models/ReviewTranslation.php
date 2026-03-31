<?php

namespace Modules\Sni\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewTranslation extends Model
{
    public $timestamps = true;
    protected $fillable = ['message', 'locale', 'review_id'];
}
