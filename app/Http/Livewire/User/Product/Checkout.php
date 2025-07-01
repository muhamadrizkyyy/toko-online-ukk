<?php

namespace App\Http\Livewire\User\Product;

use App\Helpers\MidtransRequestBuilder;
use App\Models\Cart;
use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Checkout extends Component
{
    public $data_product;

    public $qty = 1, $total = "-", $methods, $fee_shipping, $shipping_id;

    public $charge_param, $transaction_data = [];

    public function mount($id = null)
    {
        if ($id) {
            $this->data_product = Product::find($id);
            $this->getFeeShipping();
            $this->getTotal();
        }
    }

    public function getFeeShipping()
    {
        $u = User::find(Auth::id());

        $shipping = Shipping::where("province_id", $u->province_id)->where("regency_id", $u->regency_id)->first();
        $this->fee_shipping = $shipping->fee;
        $this->shipping_id = $shipping->id;
    }

    public function getTotal()
    {
        $this->total = $this->fee_shipping + ($this->data_product->price * $this->qty);
    }

    public function incrementQty()
    {
        if ($this->qty >= $this->data_product->stock) {
            $this->data_product->stock;
        } else {
            $this->qty++;
        }

        $this->getTotal();
    }

    public function decrementQty()
    {
        if ($this->qty <= 1) {
            $this->qty = 1;
        } else {
            $this->qty--;
        }

        if ($this->qty != 0) {
            $this->getTotal();
        }
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
                "amount" => 1,
                "total" => $this->total
            ]);

            TransactionDetail::create([
                "transaction_id" => $trans->id,
                "product_id" => $this->data_product->id,
                "qty" => $this->qty,
                "subtotal" => $this->qty * $this->data_product->price,
            ]);

            $serverkey = config("midtrans.server_key");

            $this->transaction_data = [
                "transaction_details" => [
                    "order_id" => $trans->transaction_code,
                    "gross_amount" => $trans->total,
                ],

                "item_details" => [
                    [
                        "name" => $this->data_product->name,
                        "price" => $this->data_product->price,
                        "quantity" => $this->qty,
                    ],
                    [
                        "name" => "Shipping Fee",
                        "price" => $this->fee_shipping,
                        "quantity" => 1,
                    ],

                ],

                "customer_details" => [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                    "phone" => Auth::user()->phone
                ]
            ];

            if ($payment_method->payment_type == "bank_transfer") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type, ["bank" => $payment_method->payment_name]);
            } elseif ($payment_method->payment_type == "echannel") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type, [
                    "bill_info1" => "Payment for:",
                    "bill_info2" => "Item descriptions",
                ]);
            } elseif ($payment_method->payment_type == "permata") {
                $this->charge_param = $this->midtransChargeParam($payment_method->payment_type);
            }

            // dd($this->charge_param);

            $response = Http::withBasicAuth($serverkey, "")->post("https://api.sandbox.midtrans.com/v2/charge", $this->charge_param);
            $response = json_encode($response->json());
            // $response = json_decode($response, true);

            if (json_decode($response, true)["status_code"] != "201") {
                throw new \Exception("Transaction was failed!");
            }


            Payment::create([
                "transaction_id" => $trans->id,
                "payment_date" => Carbon::now()->format("Y-m-d"),
                "payment_logs" => $response,
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

    public function getPaymentMethod()
    {
        return PaymentMethod::all();
    }

    public function render()
    {
        return view('livewire.user.product.checkout')->layout('layouts.user');
    }

    private function midtransChargeParam($payment_type, $payment_data = null)
    {
        return MidtransRequestBuilder::build($this->transaction_data, $payment_type, $payment_data);
    }
}
