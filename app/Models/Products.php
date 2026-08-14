<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'cate_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function color()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }

    /**
     * Alias for color relationship to ensure backward/plural compatibility
     */
    public function colors()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }
}
