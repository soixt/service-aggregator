<?php

namespace App\Traits;

use App\Models\Services\Payments\PaymentOrder;
use App\Models\Services\SMS\SmsProcess;

trait ServicesTrait {

    public function payments () {
        return $this->hasMany(PaymentOrder::class);
    }

    public function sms () {
        return $this->hasMany(SmsProcess::class);
    }
}