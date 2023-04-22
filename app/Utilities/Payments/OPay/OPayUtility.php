<?php

namespace App\Utilities\Payments\OPay;

use App\Models\Core\ProviderProjectActiveService;
use UtilityInterface;

class OPayUtility implements UtilityInterface {
    protected $providerPerActiveServiceConfig, $providerConfig;

    public function __construct(ProviderProjectActiveService $providerPerActiveService) {
        $this->providerPerActiveServiceConfig = $providerPerActiveService->config;
        $this->providerConfig = $providerPerActiveService->provider->metadata;
    }

    public function pay (array $params): array {
        return $params;
    }

    public function withdraw(array $params): array {
        return $params;
    }

    public function status(array $params): array {
        return [];
    }

    public function metadata(): mixed {
        return [];
    }
}