<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectActiveService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'active_service_id',
        'status'
    ];

    public function activeServices () {
        return $this->belongsTo(ActiveService::class, 'active_service_id')->with('service');
    }

    public function providersPerActiveService () {
        return $this->hasMany(ProviderProjectActiveService::class)->with('provider');
    }

    public function project () {
        return $this->belongsTo(Project::class);
    }
}
