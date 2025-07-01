<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $listeners = [
        "changeStatus"
    ];

    public function getTransaction()
    {
        return Transaction::all();
    }

    public function changeStatus($id = null)
    {
        try {
            $p = Transaction::find($id);

            if ($p->status == "pending") {
                $p->status = "sending";
                $p->transaction_sending = now()->format("Y-m-d");
            } else if ($p->status == "sending") {
                $p->status = "completed";
                $p->transaction_completed = now()->format("Y-m-d");
            } else if ($p->status == "pending cancelled") {
                $p->status = "cancelled";
                $p->transaction_cancelled = now()->format("Y-m-d");

                // $td = TransactionDetail::where("transaction_id", $p->id)->get();
                // foreach($td as $item) {
                //     $prod = Product::find($item->product_id);
                //     $prod->stock = $prod->stock + $item->qty;
                //     $prod->save();
                // }
            }

            $p->save();
            session()->flash("success", "Status was successfully changed!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("change status transaction failed" . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.transaction.table')->layout('layouts.admin');
    }
}
