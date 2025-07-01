<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            "payment_type" => "bank_transfer",
            "payment_name" => "bni",
        ]);
        PaymentMethod::create([
            "payment_type" => "bank_transfer",
            "payment_name" => "bri",
        ]);
        PaymentMethod::create([
            "payment_type" => "echannel",
            "payment_name" => "mandiri",
        ]);
        PaymentMethod::create([
            "payment_type" => "permata",
            "payment_name" => "permata",
        ]);
    }
}
