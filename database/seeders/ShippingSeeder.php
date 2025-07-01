<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::create([
            "province_id" => 11,
            "regency_id" => 1101,
            "fee" => 5000,
        ]);

        Shipping::create([
            "province_id" => 11,
            "regency_id" => 1102,
            "fee" => 7000,
        ]);

        Shipping::create([
            "province_id" => 11,
            "regency_id" => 1103,
            "fee" => 10000,
        ]);
    }
}
