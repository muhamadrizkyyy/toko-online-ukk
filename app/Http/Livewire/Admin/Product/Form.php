<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $product_id;
    public $category_id, $name, $slug, $stock, $price, $image, $desc;

    public function mount($id = null)
    {
        if ($id) {
            $p = Product::find($id);
            $this->product_id = $id;
            $this->name = $p->name;
            $this->slug = $p->slug;
            $this->price = $p->price;
            $this->stock = $p->stock;
            $this->desc = $p->desc;
            $this->category_id = $p->category_id;
        }
    }

    public function saveData()
    {
        if ($this->product_id) {
            $this->validate([
                "name" => "required",
                "slug" => "required",
                "category_id" => "required",
                "price" => "required",
                "stock" => "required",
                "desc" => "required",
                "image" => "nullable|image|mimes:jpg,jpeg,png,webp"
            ]);
        } else {
            $this->validate([
                "name" => "required",
                "slug" => "required",
                "category_id" => "required",
                "price" => "required",
                "stock" => "required",
                "desc" => "required",
                "image" => "required|image|mimes:jpg,jpeg,png,webp"
            ]);
        }


        if ($this->image) {
            $filename = "PRD-" . time() . "." . $this->image->extension();
            $this->image->storeAs("public/products", $filename);
        }

        try {
            if ($this->product_id) {
                $p = Product::find($this->product_id);
                $p->name = $this->name;
                $p->slug = $this->slug;
                $p->price = $this->price;
                $p->stock = $this->stock;
                $p->desc = $this->desc;
                $p->category_id = $this->category_id;
                if ($this->image) {
                    Storage::delete("public/product/" . $p->image);
                    $p->image = $filename;
                }
                $p->save();
            } else {

                Product::create([
                    "name" => $this->name,
                    "slug" => $this->slug,
                    "price" => $this->price,
                    "stock" => $this->stock,
                    "category_id" => $this->category_id,
                    "desc" => $this->desc,
                    "image" => $filename,
                ]);
            }

            return redirect()->route("product")->with("success", "Data was successfully saved!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("product crud failed" . $th->getMessage());
        }
    }

    public function getCategory()
    {
        return Category::all();
    }

    public function UpdatedName()
    {
        $loweCase = strtolower($this->name);
        $slug = str_replace(" ", "-", $loweCase);

        if (Product::where("slug", $slug)->get()) {
            $slug = $slug . "-" . uniqid();
        }

        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.admin.product.form')->layout('layouts.admin');
    }
}
