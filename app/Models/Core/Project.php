<?php

namespace App\Models\Core;

use App\Traits\ServicesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes, ServicesTrait;

    protected $fillable = [
        'name',
        'client_id',
        'metadata',
        'public_key',
        'private_key'
    ];

    public function projectActiveService () {
        return $this->hasMany(ProjectActiveService::class);
    }

    // Add setter for generating keys automatically

    public function apiCalls () {
        return $this->hasMany(APICall::class);
    }
}
