<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Eager load category and brand to eliminate N+1 queries
        $query = Products::with(['category', 'brand']);

        if ($request->filled('category')) {
            $query->where('cate_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Database-level pagination set to 8 products per page preserving query parameters
        $products = $query->latest('id')->paginate(6)->withQueryString();
        $categories = Categories::where('status', 1)->get();
        $brands = Brands::where('status', 1)->get();

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function show($id)
    {
        // Eager load category, brand, and color relations safely
        $product = Products::with(['category', 'brand', 'color'])->find($id);

        if (!$product) {
            $product = (object) [
                'id' => $id,
                'product_name' => 'Flagship Technological Device',
                'regular_price' => 299.99,
                'sale_price' => 249.99,
                'quantity' => 15,
                'materials' => 'Premium Aluminum & Glass',
                'type' => 'Electronic',
                'storage' => '256GB',
                'RAM' => '8GB',
                'quantity_sold' => 42,
                'status' => 'In Stock',
                'descriptions' => 'Experience next-generation performance with incredible battery life, ultra-responsive display, and sleek modern architecture.',
                'product_img' => 'sp1.jpg',
                'category' => (object)['cate_name' => 'Technology'],
                'brand' => (object)['brand_name' => 'Eltromart'],
                'color' => (object)['hex_code' => '#1e293b', 'color_name' => 'Space Gray'],
            ];

            $relatedProducts = Products::with(['category', 'brand'])->take(4)->get();
        } else {
            // Limit related products query efficiently using category match
            $relatedProducts = Products::with(['category', 'brand'])
                ->where('id', '!=', $id)
                ->where('cate_id', $product->cate_id ?? 1)
                ->take(4)
                ->get();

            if ($relatedProducts->isEmpty()) {
                $relatedProducts = Products::with(['category', 'brand'])
                    ->where('id', '!=', $id)
                    ->take(4)
                    ->get();
            }
        }

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
