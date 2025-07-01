<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function shipping() {
        return $this->belongsTo(Shipping::class, "shipping_id", "id");
    }

    public function buyer() {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
