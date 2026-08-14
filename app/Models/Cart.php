<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    use HasFactory;
    protected $table = "cart";
    protected $fillable = ['user_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function user()
    {
        return $this->belongsTo(Products::class);
    }
}
