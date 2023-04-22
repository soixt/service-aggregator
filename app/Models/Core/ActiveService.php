<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'service_id',
        'status'
    ];

    public function service () {
        return $this->belongsTo(Service::class);
    }

    public function client () {
        return $this->belongsTo(Client::class);
    }

    public function projects () {
        return $this->belongsToMany(ProjectActiveService::class);
    }
}