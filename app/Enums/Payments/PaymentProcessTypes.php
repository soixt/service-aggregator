<?php

namespace App\Enums\Payments;

enum PaymentProcessTypes {
    case PAY;
    case WITHDRAW;
    case REFUND;
}