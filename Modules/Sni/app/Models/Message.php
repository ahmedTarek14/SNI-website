<?php

namespace Modules\Sni\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Service\Models\Service;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'company', 'message', 'service_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
