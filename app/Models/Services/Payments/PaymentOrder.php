<?php

namespace App\Models\Services\Payments;

use App\Enums\Payments\PaymentOrderService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_order_service';

    protected $fillable = [
        'provider_project_active_service_id',
        PaymentOrderService::CURRENCY,
        PaymentOrderService::AMOUNT,
        PaymentOrderService::STATUS,
        PaymentOrderService::CLIENT_REFERENCE,
        PaymentOrderService::PROVIDER_REFERENCE,
        PaymentOrderService::DESCRIPTION,
        PaymentOrderService::CUSTOMER_INFO,
        PaymentOrderService::METADATA
    ];

    public function paymentProcess () {
        return $this->hasMany(PaymentProcess::class);
    }
}
