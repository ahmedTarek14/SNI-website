<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChallengeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'challenge', 'solution', 'result', 'description', 'challenge_id', 'locale'];
}
