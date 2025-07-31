<?php

return [
    "cost_api_key" => env("RAJAONGKIR_SHIPPING_COST_API_KEY", ""),

    /*
     * Set your account package type
     * Example: basic, starter, pro
     */
    'package' => env('RAJAONGKIR_PACKAGE', 'starter'),

    /*
     * Set the connection timeout for the requests
     */
    'timeout' => env('RAJAONGKIR_TIMEOUT', 30),

    "base_url" => "https://rajaongkir.komerce.id/api/v1/",
];
