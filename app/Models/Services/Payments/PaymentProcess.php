<?php

namespace App\Models\Services\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentProcess extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_process_service';

    protected $fillable = [
        'payment_order_service_id',
        'amount',
        'type',
        'status',
        'metadata'
    ];
}
