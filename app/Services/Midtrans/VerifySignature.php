<?php

namespace App\Services\Midtrans;

class VerifySignature
{
    public static function verify($gross_amount = null, $order_id = null, $status_code = null, $signature_key = null)
    {
        if ($gross_amount && $order_id && $status_code) {
            $signature = hash('sha256', $gross_amount . $order_id . $status_code . config("midtrans.server_key"));
            if ($signature_key != $signature) {
                return response()->json([
                    'message' => 'Signature not incorrect'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Missing parameter'
            ], 400);
        }
    }
}
