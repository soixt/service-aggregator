<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderProjectActiveService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_active_service_id',
        'provider_id',
        'config'
    ];

    protected $casts = [
        'config' => 'array'
    ];

    public function provider () {
        return $this->belongsTo(Provider::class);
    }

    public function projectActiveService () {
        return $this->belongsTo(ProjectActiveService::class);
    }
}
