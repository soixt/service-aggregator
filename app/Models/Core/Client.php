<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'metadata',
        'status',
    ];

    public function users () {
        return $this->belongsToMany(User::class);
    }

    public function services () {
        return $this->hasMany(ActiveService::class)->with('service');
    }

    public function projects () {
        return $this->hasMany(Project::class)->with('projectActiveService');
    }
}
