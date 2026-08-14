<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    //
    public function product()
    {
        return $this->hasOne(Products::class, 'color_id');
    }
}
