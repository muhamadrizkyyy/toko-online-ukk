<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function countProduct() {
        return Product::all()->count();
    }

    public function countUser() {
        return User::where("role", "buyer")->count();
    }

    public function countTransactionCompleted() {
        return Transaction::where("status", "completed")->count();
    }

    public function countTransactionPending() {
        return Transaction::where("status", "pending")->count();
    }

    public function countTransactionSending() {
        return Transaction::where("status", "sending")->count();
    }

    public function countTransactionCancelled() {
        return Transaction::where("status", "cancelled")->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.admin');
    }
}
