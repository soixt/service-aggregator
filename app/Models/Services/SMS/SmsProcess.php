<?php

namespace App\Models\Services\SMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsProcess extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sms_process_service';

    protected $fillable = [
        'provider_project_active_service_id',
        'country_id',
        'phone_number',
        'type',
        'message',
        'status',
        'metadata'
    ];

    public function service () {
        return $this->morphMany(Service::class, 'serviceable');
    }
}
