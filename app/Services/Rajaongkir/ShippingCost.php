<?php

namespace App\Services\Rajaongkir;

use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShippingCost
{
    public static function getSubDistrictID()
    {
        $buyer = Buyer::where("user_id", Auth::id())->first();
        $village = $buyer->getVillage->name;

        if (!session()->has("subDistrictID")) {
            try {
                $subDistrict = Http::withHeaders([
                    "key" => config('rajaongkir.cost_api_key')
                ])->get(config("rajaongkir.base_url") . "destination/domestic-destination?search=" . $village . "&limit=1");

                $subDistrictID = json_decode($subDistrict)->data[0]->id;

                // set session subDistrictID
                session(["subDistrictID" => $subDistrictID]);
                return $subDistrictID;
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", "Gagal mendapatkan data ongkir " . $th->getMessage());
                Log::error("Error getSubDistrictID: " . $th->getMessage());
            }
        }
    }

    public static function getDomesticCost($origin = 46125, $destination, $weight, $courier)
    {
        $data = [
            "origin" => $origin,
            "destination" => $destination,
            "weight" => $weight,
            "courier" => $courier
        ];

        try {
            //http with body reqs application/x-www-form-urlencoded
            $response = Http::withHeaders([
                'key' => config('rajaongkir.cost_api_key'),
            ])->asForm()->post(config("rajaongkir.base_url") . "calculate/domestic-cost", $data);

            return $response->json()["data"];
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Gagal menghitung ongkir " . $th->getMessage());
            Log::error("Error getSubDistrictID: " . $th->getMessage());
        }
    }
}
