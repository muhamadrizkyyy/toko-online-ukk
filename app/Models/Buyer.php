<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function getVillage()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
