<?php

namespace App\Models\Core;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description'
    ];

    public function activeServices () {
        return $this->hasMany(ActivatedService::class);
    }

    public function providers () {
        return $this->hasMany(Provider::class);
    }
    
    public function apiCalls () {
        return $this->hasMany(APICall::class);
    }
    
    public function slug (): Attribute {
        return Attribute::make(
            set: fn () => Str::of($this->name)->slug('-')
        );
    }
}
