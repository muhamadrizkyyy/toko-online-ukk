<?php

namespace App\Http\Livewire\User\History;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\Midtrans\Transaction as MidtransTransaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Detail extends Component
{
    use WithFileUploads;

    public $transaction_id, $data_trans, $proof;
    public $listeners = [
        "changeStatus"
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->transaction_id = $id;
            $this->getTransactionById();
        }
    }

    // public function uploadProof()
    // {
    //     $this->validate([
    //         "proof" => "required|image"
    //     ]);

    //     try {
    //         $filename = "PRF-" . time() . "." . $this->proof->extension();
    //         $this->proof->storeAs("public/proof", $filename);

    //         Payment::with("methods")->where("transaction_id", $this->transaction_id)->first()->update([
    //             "proof" => $filename,
    //             "payment_date" => now()->format("Y-m-d")
    //         ]);

    //         session()->flash("success", "Proof was successfully sent!");
    //     } catch (\Throwable $th) {
    //         session()->flash("error", "Something went wrong!");
    //         Log::info("upload proof crud failed " . $th->getMessage());
    //     }
    // }

    public function changeStatus($id = null, $state = null)
    {
        try {
            $this->getTransactionById();
            $t = $this->data_trans;


            if ($state == "completed") {
                $t->status = "completed";
                $t->transaction_completed = now()->format("Y-m-d");
                $t->save();
            } else if ($state == "cancelled") {
                $cancel_resp = MidtransTransaction::cancel($t->transaction_code);
                $cancel_resp = json_decode($cancel_resp->getBody()->getContents());

                if ($cancel_resp->status_code == "200") {
                    $t->status = "cancelled";
                    $t->transaction_cancelled = now()->format("Y-m-d");
                    $t->save();

                    $paymentLogs = $this->getPayment();
                    $paymentLogs->payment_status = "cancelled";
                    $paymentLogs->payment_logs = json_encode($cancel_resp);
                    $paymentLogs->save();
                } else {
                    throw new Exception("Something went wrong! | " . $cancel_resp->status_message);
                }
            }

            Log::info("change status transaction success " . $state);
            session()->flash("success", "Status was successfully changed!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("change status transaction failed " . $th->getMessage());
        }
    }

    public function getTransactionById()
    {
        $this->data_trans = Transaction::find($this->transaction_id);
    }

    public function getTransactionDetail($id = null)
    {
        return TransactionDetail::where("transaction_id", $this->transaction_id)->get();
    }

    public function getPayment($id = null)
    {
        return Payment::with("methods")->where("transaction_id", $this->transaction_id)->first();
    }

    public function getPaymentLogs()
    {
        return json_decode($this->getPayment()->payment_logs, true);
    }

    public function paymentStatusCheck($trx_code = null)
    {
        try {
            $response = MidtransTransaction::status($trx_code);

            $response = $response->json();
            $trans = Transaction::where("transaction_code", $trx_code)->first();
            $paymentLogs = Payment::where("transaction_id", $trans->id)->first();

            if ($response["transaction_status"] == "settlement") {
                $trans->status = "sending";
                $trans->transaction_sending = now()->format("Y-m-d");
                $paymentLogs->payment_status = "paid";
                $paymentLogs->payment_logs = json_encode(MidtransTransaction::status($trx_code));
                $paymentLogs->save();
                $trans->save();
            } elseif ($response["transaction_status"] == "expire" || $response["transaction_status"] == "failure" || $response["transaction_status"] == "cancel") {
                $trans->status = "cancelled";
                $trans->transaction_cancelled = now()->format("Y-m-d");
                $paymentLogs->payment_status = $response["transaction_status"] == "cancel" ? "cancelled" : $response["transaction_status"];
                $paymentLogs->payment_logs = json_encode(MidtransTransaction::status($trx_code));
                $paymentLogs->save();
                $trans->save();
            }



            $this->data_trans = $trans;
            Log::info("status check success " . json_encode($response));
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong, please try again later and contact administrator!");
            Log::info("status check failed " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.history.detail')->layout('layouts.user');
    }
}
