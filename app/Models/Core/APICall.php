<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APICall extends Model
{
    use HasFactory;

    protected $table = 'api_calls';

    protected $fillable = [
        'project_id',
        'service_id',
        'provider_id',
        'status',
        'url',
        'action'
    ];

    public function project () {
        return $this->belongsTo(Project::class);
    }

    public function service () {
        return $this->belongsTo(Service::class);
    }

    public function provider () {
        return $this->belongsTo(Provider::class);
    }
}
