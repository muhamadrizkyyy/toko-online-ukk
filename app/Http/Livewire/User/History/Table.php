<?php

namespace App\Http\Livewire\User\History;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Table extends Component
{
    public function getTransactionByUser() {
        return Transaction::where("user_id", Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.user.history.table')->layout('layouts.user');
    }
}
