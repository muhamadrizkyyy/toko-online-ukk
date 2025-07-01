<?php

namespace App\Http\Livewire\User\Product;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Detail extends Component
{
    public $product, $qty = 1, $slug, $stock;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        $p = Product::where("slug", $slug)->first();
        $this->product = $p;
        $this->stock = $p->stock;
    }

    public function incrementQty()
    {
        if ($this->qty >= $this->stock) {
            $this->stock;
        } else {
            $this->qty++;
        }
    }

    public function decrementQty()
    {
        if ($this->qty <= 1) {
            $this->qty = 1;
        } else {
            $this->qty--;
        }
    }

    public function addToCart($id = null)
    {
        if (!Auth::check()) {
            return redirect()->route("login")->with("error", "You are not logged in yet");
        }

        try {
            $cart = Cart::where("product_id", $id)->where("user_id", Auth::user()->id)->first();
            $price_product = Product::find($id)->price;

            if ($cart) {
                $cart->qty = $cart->qty + 1;
                $cart->subtotal = $cart->qty * $price_product;
                $cart->save();
            } else {
                Cart::create([
                    "user_id" => Auth::user()->id,
                    "product_id" => $id,
                    "qty" => $this->qty,
                    "subtotal" => $price_product * $this->qty
                ]);
            }

            session()->flash("success", "Product was successfully added!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("add to cart failed " . $th->getMessage());
        }
    }

    public function getProduct()
    {
        return Product::where("slug", "!=", $this->slug)->get();
    }

    public function render()
    {
        return view('livewire.user.product.detail')->layout('layouts.user');
    }
}
