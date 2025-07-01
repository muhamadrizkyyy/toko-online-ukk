<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Form extends Component
{
    public $category_id;
    public $name, $slug;


    public function mount($id = null) {
        if ($id) {
            $c = Category::find($id);
            $this->category_id = $id;
            $this->name = $c->name;
            $this->slug = $c->slug;
        }
    }

    public function UpdatedName() {
        $loweCase = strtolower($this->name);
        $slug = str_replace(" ", "-", $loweCase);
        $this->slug = $slug;
    }

    public function saveData() {
        $validate = $this->validate([
            "name" => "required",
            "slug" => "required",
        ]);

        try {
            if($this->category_id) {
                Category::find($this->category_id)->update([
                    "name" => $this->name,
                    "slug" => $this->slug,
                ]);
            } else {
                Category::create([
                    "name" => $this->name,
                    "slug" => $this->slug,
                ]);
            }

            return redirect()->route("category")->with("success", "Data was successfully saved!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("category crud failed" . $th->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.admin.category.form')->layout('layouts.admin');
    }
}
