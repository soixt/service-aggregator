<?php

namespace App\Http\Requests\Payments;

use App\Enums\PaymentOrderService;
use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            PaymentOrderService::CLIENT_REFERENCE => 'required|exists:payment_order_service,' . PaymentOrderService::CLIENT_REFERENCE
        ];
    }
}
