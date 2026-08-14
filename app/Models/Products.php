<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }

    public function color()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }
}
