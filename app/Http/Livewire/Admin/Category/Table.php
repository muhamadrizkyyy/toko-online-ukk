<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $listeners = [
        "deleteData" => "delete"
    ];

    public function getCategory() {
        return Category::paginate(10);
    }

    public function delete($id = null) {
        try {
            Category::find($id)->delete();
            session()->flash("success", "Data was successfully deleted!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("category crud failed" . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.category.table')->layout('layouts.admin');
    }
}
