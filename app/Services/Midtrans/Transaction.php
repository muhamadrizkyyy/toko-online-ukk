<?php

namespace App\Services\Midtrans;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Transaction
{
    public static function charge($charge_param)
    {
        return Http::withBasicAuth(config("midtrans.server_key"), "")
            ->withHeaders([
                'X-Append-Notification' => config("midtrans.demo_url") . "callback-notification"
            ])
            ->post(config("midtrans.sandbox_base_url") . "v2/charge", $charge_param);
    }

    public static function status($id)
    {
        return Http::withBasicAuth(config('midtrans.server_key'), '')->get(config("midtrans.sandbox_base_url") . "v2/" . $id . "/status");
    }

    public static function cancel($id)
    {
        $client = new Client();

        return $client->post(
            config("midtrans.sandbox_base_url") . "v2/" . $id . "/cancel",
            [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
                    'X-Append-Notification' => config("midtrans.demo_url") . "callback-notification"
                ]
            ]
        );
    }
}
