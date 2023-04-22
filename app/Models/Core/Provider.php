<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'metadata',
        'service_id'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function service () {
        return $this->belongsTo(Service::class);
    }

    public function providersPerActiveService () {
        return $this->hasMany(ProviderProjectActiveService::class);
    }
    
    public function slug (): Attribute {
        return Attribute::make(
            set: fn () => Str::of($this->name)->slug('-')
        );
    }
    
    public function apiCalls () {
        return $this->hasMany(APICall::class);
    }
}
