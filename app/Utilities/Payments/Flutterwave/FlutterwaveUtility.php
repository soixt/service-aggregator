<?php

namespace App\Utilities\Payments\Flutterwave;

use App\Enums\Payments\PaymentOrderService;
use App\Enums\Payments\PaymentProcessTypes;
use App\Enums\Payments\PaymentStatus;
use App\Models\Core\ProviderProjectActiveService;
use App\Models\Services\Payments\PaymentOrder;
use Illuminate\Support\Facades\Http;
use UtilityInterface;

class FlutterwaveUtility implements UtilityInterface {

    protected $providerPerActiveServiceConfig, $providerConfig;

    public function __construct(ProviderProjectActiveService $providerPerActiveService) {
        $this->providerPerActiveServiceConfig = $providerPerActiveService->config;
        $this->providerConfig = $providerPerActiveService->provider->metadata;
    }

    public function pay(array $params): array {
        $order = PaymentOrder::create([
            PaymentOrderService::ADDITIONAL_DATA => [
                PaymentOrderService::ADDITIONAL_DATA_PAYMENT_OPTIONS => $this->providerPerActiveServiceConfig[PaymentOrderService::ADDITIONAL_DATA_PAYMENT_OPTIONS],
                PaymentOrderService::ADDITIONAL_DATA_REDIRECT_URL => config('payments.flutterwave.url.success_redirect')
            ],
            ...$params
        ]);

        try {
            $response = Http::acceptJson()->withHeaders([
                'Authorization' => $this->providerPerActiveServiceConfig['secret_key']
            ])->post(config('payments.flutterwave.url.production') . config('payments.flutterwave.url.pay'), $this->map($order));

            if (empty($response->body()['status']) || $response->body()['status'] !== 'success' || empty($response->body()['data']['link'])) {
                throw new \Exception('Flutterwave request failed or response format malformed.');
            }

            return [
                'order' => $order,
                'response' => $response->body()['data']['link']
            ];
        } catch (\Throwable $th) {
            $order->update(['status' => PaymentStatus::FAILED]);
            throw $th;
        }
    }

    public function withdraw(array $params): array {
        $order = PaymentOrder::where(PaymentOrderService::CLIENT_REFERENCE, '=', $params[PaymentOrderService::CLIENT_REFERENCE])->firstOrFail();
        try {
            $this->validAccount($params);

            $response = Http::acceptJson()->withHeaders([
                'Authorization' => $this->providerPerActiveServiceConfig['secret_key']
            ])->post(config('payments.flutterwave.url.production') . config('payments.flutterwave.url.withdraw'), );

            return $order;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status(array $params): array {
        $order = PaymentOrder::where(PaymentOrderService::CLIENT_REFERENCE, '=', $params[PaymentOrderService::CLIENT_REFERENCE])->firstOrFail();
        if (!in_array($order->status, [PaymentStatus::SUCCESS, PaymentStatus::FAILED, PaymentStatus::CANCELED])) {
            return $order;
        }

        $type = $order->paymentProcess->first()->type;

        try {
            switch (true) {
                case $type === PaymentProcessTypes::WITHDRAW:
                    $response = Http::acceptJson()->withHeaders([
                        'Authorization' => $this->providerPerActiveServiceConfig['secret_key']
                    ])->get(config('payments.flutterwave.url.production') . sprintf(config('payments.flutterwave.url.withdraw_status'), $params[PaymentOrderService::CLIENT_REFERENCE]));

                    if (empty($response->body()['status']) || (empty($response->body()['data']) && empty($response->body()['transfer']))) {
                        throw new \Exception('Invalid transaction verification response.');
                    }
                    break;
                
                case $type === PaymentProcessTypes::PAY:
                    $response = Http::acceptJson()->withHeaders([
                        'Authorization' => $this->providerPerActiveServiceConfig['secret_key']
                    ])->get(config('payments.flutterwave.url.production') . sprintf(config('payments.flutterwave.url.pay_status'), $params[PaymentOrderService::CLIENT_REFERENCE]));
                    break;
            }

            $order->update(['status' => $response->body()['status']]);// map to our statuses

            return $order;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function validAccount (array $params) {
        try {
            $response = Http::acceptJson()->withHeaders([
                'Authorization' => $this->providerPerActiveServiceConfig['secret_key']
            ])->post(config('payments.flutterwave.url.production') . config('payments.flutterwave.url.resolve'), [
                PaymentOrderService::CUSTOMER_INFO_ACCOUNT_NUMBER => $params[PaymentOrderService::CUSTOMER_INFO_ACCOUNT_NUMBER], 
                PaymentOrderService::CUSTOMER_INFO_ACCOUNT_BANK => $params[PaymentOrderService::CUSTOMER_INFO_ACCOUNT_BANK]
            ]);

            if (empty($response->body()['status']) || $response->body()['status'] !== 'success') {
                throw new \Exception('Flutterwave request failed or response format malformed.');
            }

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function map (PaymentOrder $order) : array {
        $mapped = $order->exclude([
            PaymentOrderService::ADDITIONAL_DATA, 
            PaymentOrderService::STATUS,
            PaymentOrderService::PROVIDER_REFERENCE,
            'created_at', 'updated_at',
            'provider_project_active_service_id',
            'provider_id'
        ])->toArray();
        
        $mapped[PaymentOrderService::ADDITIONAL_DATA_PAYMENT_OPTIONS] = $order->PaymentOrderService::ADDITIONAL_DATA[PaymentOrderService::ADDITIONAL_DATA_PAYMENT_OPTIONS];
        $mapped[PaymentOrderService::ADDITIONAL_DATA_REDIRECT_URL] = $order->PaymentOrderService::ADDITIONAL_DATA[PaymentOrderService::ADDITIONAL_DATA_REDIRECT_URL];
        
        return $mapped;
    }
}