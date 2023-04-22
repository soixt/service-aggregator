<?php

namespace App\Enums\Payments;

class PaymentStatus {
    const SUCCESS = "success";
    const FAILED = "failed";
    const INIT = "init";
    const PENDING = "pending";
    const CANCELED = "canceled";
}