<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Project\Database\Factories\ImpactNumberFactory;

class ImpactNumber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['satisfied_clients', 'completed_projects', 'years_of_experience', 'success_rate'];
}
