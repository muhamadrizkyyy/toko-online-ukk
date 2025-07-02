<?php

namespace App\Http\Livewire\User\Cart;

use App\Helpers\MidtransRequestBuilder;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Services\Midtrans\Transaction as MidtransTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Checkout extends Component
{
    public $province, $regency, $shipping_id, $fee_shipping, $subtotal, $methods;
    public $charge_param, $transaction_data = [];

    public function mount()
    {
        $u = User::find(Auth::user()->id);
        $this->province = $u->province_id;
        $this->regency = $u->regency_id;

        $shipping = Shipping::where("province_id", $this->province)->where("regency_id", $this->regency)->first();

        $this->fee_shipping = $shipping->fee;
        $this->shipping_id = $shipping->id;

        $total = 0;
        foreach ($this->getCartByUser() as $key => $value) {
            $total = $value->subtotal + $total;
        }

        $this->subtotal = $total;
    }

    public function checkout()
    {
        $this->validate([
            "methods" => "required"
        ], [
            "methods" => "Payment methods is must be filled!"
        ]);

        $payment_method = PaymentMethod::find($this->methods);
        $latest = Transaction::latest()->first();

        if ($latest) {
            $split_code = explode("-", $latest->transaction_code);
            $incCode = end($split_code) + 1;
            $trx_code = str_pad("TRX-", 7, 0) . $incCode;
        } else {
            $trx_code = "TRX-0001";
        }

        try {
            DB::beginTransaction();

            $trans = Transaction::create([
                "transaction_code" => $trx_code,
                "user_id" => Auth::user()->id,
                "shipping_id" => $this->shipping_id,
                "transaction_date" => now()->format("Y-m-d"),
                "status" => "pending",
                "amount" => count($this->getCartByUser()),
                "total" => $this->subtotal + $this->fee_shipping
            ]);

            // payload midtrans
            $this->transaction_data = [
                "transaction_details" => [
                    "order_id" => $trans->transaction_code,
                    "gross_amount" => $trans->total,
                ],

                "item_details" => [
                    [
                        "name" => "Shipping Fee",
                        "price" => $this->fee_shipping,
                        "quantity" => 1,
                    ]
                ],

                "customer_details" => [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                    "phone" => Auth::user()->phone
                ]
            ];

            // transaction detail
            foreach ($this->getCartByUser() as $key => $value) {
                TransactionDetail::create([
                    "transaction_id" => $trans->id,
                    "product_id" => $value->product_id,
                    "qty" => $value->qty,
                    "subtotal" => $value->subtotal,
                ]);

                $item_detail = [
                    "name" => $value->product->name,
                    "price" => $value->product->price,
                    "quantity" => $value->qty,
                ];

                $this->transaction_data["item_details"][] = $item_detail;

                Cart::find($value->id)->delete();
            }

            $serverkey = config("midtrans.server_key");

            if ($payment_method->payment_type == "bank_transfer") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type, [
                    "bank" => $payment_method->payment_name
                ]);
            } elseif ($payment_method->payment_type == "echannel") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type, [
                    "bill_info1" => "Payment for:",
                    "bill_info2" => "Item descriptions",
                ]);
            } elseif ($payment_method->payment_type == "permata") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type);
            } elseif ($payment_method->payment_type == "qris") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type, [
                    "acquirer" => "gopay",
                ]); //aqurier = gopay or shopee
            }

            $response = MidtransTransaction::charge($this->charge_param);
            $response = json_decode($response);

            if ($response->status_code != "201") {
                throw new \Exception("Transaction was failed!");
            }

            Payment::create([
                "transaction_id" => $trans->id,
                "payment_date" => Carbon::now()->format("Y-m-d"),
                "payment_logs" => json_encode($response),
                "payment_method_id" => $this->methods
            ]);

            DB::commit();

            return redirect()->route("history")->with("success", "Transaction was successfully created!");
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash("error", "Something went wrong!");
            Log::info("co failed " . $th->getMessage());
        }
    }

    public function getCartByUser()
    {
        return Cart::where("user_id", Auth::user()->id)->get();
    }

    public function getPaymentMethod()
    {
        return PaymentMethod::all();
    }

    public function render()
    {
        return view('livewire.user.cart.checkout')->layout('layouts.user');
    }

    private function midtransChargeParam($payment_type, $payment_data = null)
    {
        return MidtransRequestBuilder::build($this->transaction_data, $payment_type, $payment_data);
    }
}
