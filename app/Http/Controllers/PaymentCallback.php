<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Services\Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentCallback extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $notif = new Notification();
            $trans = Transaction::where("transaction_code", $notif->order_id)->first();
            $paymentLogs = Payment::where("transaction_id", $trans->id)->first();

            if ($notif->transaction_status == "settlement") {
                $trans->status = "sending";
                $trans->transaction_sending = now()->format("Y-m-d");
                $paymentLogs->payment_status = "paid";
                $paymentLogs->save();
                $trans->save();
            } elseif ($notif->transaction_status == "expire" || $notif->transaction_status == "failure") {
                $trans->status = "cancelled";
                $trans->transaction_cancelled = now()->format("Y-m-d");
                $paymentLogs->payment_status = $notif->transaction_status;
                $paymentLogs->payment_logs = json_encode($notif->getResponse());
                $paymentLogs->save();
                $trans->save();
            }

            Log::info("Success callback from midtrans: " . json_encode($notif->getResponse()));
        } catch (\Throwable $th) {
            Log::error("Failed callback from midtrans: " . $th);
        }
    }
}
