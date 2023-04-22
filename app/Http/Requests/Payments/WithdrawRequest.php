<?php

namespace App\Http\Requests\Payments;

use App\Enums\PaymentOrderService;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            PaymentOrderService::CURRENCY => 'required',
            PaymentOrderService::AMOUNT => 'required|numeric',
            PaymentOrderService::CLIENT_REFERENCE => 'required|unique:payment_order_service,' . PaymentOrderService::CLIENT_REFERENCE,
            PaymentOrderService::DESCRIPTION => 'required',
            PaymentOrderService::CUSTOMER_INFO => 'required|array',
            PaymentOrderService::CUSTOMER_INFO . '.' . PaymentOrderService::CUSTOMER_INFO_ACCOUNT_BANK => 'required',
            PaymentOrderService::CUSTOMER_INFO . '.' . PaymentOrderService::CUSTOMER_INFO_ACCOUNT_NUMBER => 'required'
        ];
    }
}
