<?php

namespace App\Utilities;

use App\Utilities\Payments\FlutterwaveUtility;
use UtilityInterface;

class MainServiceUtility {

    public function createUtility (string $service, string $provider, array $config) {
        return new (
            sprintf("\App\Utilities\%s\%s\%sUtility", 
                ucfirst($service), 
                ucfirst($provider), 
                ucfirst($provider)
            )
        )($config);
    }
}