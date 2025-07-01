<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Livewire\Component;

class Show extends Component
{
    public $transaction_id;

    public $data_trans, $detail_trans,$payments;

    public $buyer, $fee_shiping, $trans_date, $total, $code,
    $trans_send = "-", $trans_pending_cancelled = "-", $trans_cancelled = "-", $trans_completed = "-";


    public function mount($id = null) {
        if ($id) {
            $t = Transaction::find($id);
            $this->data_trans = $t;
            $this->code = $t->transaction_code;
            $this->transaction_id = $id;
            $this->trans_date = $t->transaction_date;
            $this->trans_send = $t->transaction_sending;
            $this->trans_pending_cancelled = $t->transaction_pending_cancelled;
            $this->trans_cancelled = $t->transaction_cancelled;
            $this->trans_completed = $t->transaction_completed;
            $this->fee_shiping = $t->shipping->fee;
            $this->buyer = $t->buyer->name;
            $this->total = $t->total;

            $this->detail_trans = TransactionDetail::where("transaction_id", $t->id)->get();
            $this->payments = Payment::where("transaction_id", $t->id)->first();

        }
    }

    public function render()
    {
        return view('livewire.admin.transaction.show')->layout('layouts.admin');
    }
}
