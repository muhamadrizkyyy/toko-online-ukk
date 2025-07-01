<?php

namespace App\Helpers;

class MidtransRequestBuilder
{
    public static function build($data, $payment_type, $payment_data = null)
    {
        $charge_params = $data;

        if (!is_null($payment_type)) {
            $charge_params['payment_type'] = $payment_type;
        }

        if (!is_null($payment_data)) {
            $charge_params[$payment_type] = $payment_data;
        }
        return $charge_params;
    }
};
