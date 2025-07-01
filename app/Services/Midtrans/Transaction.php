<?php

namespace App\Services\Midtrans;

use Illuminate\Support\Facades\Http;

class Transaction
{
    public static function status($id)
    {
        return Http::withBasicAuth(config('midtrans.server_key'), '')->get(config("midtrans.sandbox_base_url") . "v2/" . $id . "/status");
    }

    public static function cancel($id)
    {
        return Http::withBasicAuth(config('midtrans.server_key'), '')->post(config("midtrans.sandbox_base_url") . "v2/" . $id . "/cancel");
    }
}
