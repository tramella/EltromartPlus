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

    /**
     * Get the full Cloudinary image URL for the product image, using CLOUDINARY_IMAGE_URL env setting.
     */
    public function getImageUrlAttribute(): string
    {
        $image = $this->product_img ?? 'sp1.jpg';
        $baseUrl = config('services.cloudinary.url', env('CLOUDINARY_IMAGE_URL', 'https://res.cloudinary.com/dalrsrbw0/image/upload/v1786957890/'));

        if (!empty($baseUrl)) {
            return rtrim($baseUrl, '/') . '/' . ltrim($image, '/');
        }

        return asset('images/' . $image);
    }
}
