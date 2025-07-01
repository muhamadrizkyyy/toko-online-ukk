<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $listeners = [
        "deleteData"
    ];

    public function getUser() {
        return User::paginate(10);
    }

    public function deleteData($id) {
        try {
            User::find($id)->delete();
            session()->flash("success", "Data was successfully deleted!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("user crud failed" . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.user.table')->layout('layouts.admin');
    }
}
