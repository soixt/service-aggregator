<?php

namespace App\Enums\Payments;

class PaymentOrderService
{
    const CURRENCY = 'currency';
    const AMOUNT = 'amount';
    const CLIENT_REFERENCE = 'reference';
    const PROVIDER_REFERENCE = 'provider_reference';
    const STATUS = 'status';
    const DESCRIPTION = 'description';
    const CUSTOMER_INFO = 'customer_info';
    const CUSTOMER_INFO_FIRST_NAME = 'first_name';
    const CUSTOMER_INFO_LAST_NAME = 'last_name';
    const CUSTOMER_INFO_EMAIL = 'email';
    const CUSTOMER_INFO_PHONE_NUMBER = 'phone_number';
    const CUSTOMER_INFO_IP = 'ip_address';
    const CUSTOMER_INFO_ACCOUNT_BANK = 'account_bank';
    const CUSTOMER_INFO_ACCOUNT_NUMBER = 'account_number';
    const METADATA = 'metadata';
    const ADDITIONAL_DATA = 'additional_data';
    const ADDITIONAL_DATA_PAYMENT_OPTIONS = 'payment_options';
    const ADDITIONAL_DATA_REDIRECT_URL = 'redirect_url';
}