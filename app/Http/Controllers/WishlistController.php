<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistIds = session()->get('wishlist', []);
        $products = Products::whereIn('id', array_keys($wishlistIds))->get();

        // If DB is empty, use stored session items for demo rendering
        $wishlistItems = [];
        if ($products->count() > 0) {
            foreach ($products as $p) {
                $wishlistItems[] = [
                    'id' => $p->id,
                    'name' => $p->product_name,
                    'price' => $p->sale_price > 0 ? $p->sale_price : $p->regular_price,
                    'regular_price' => $p->regular_price,
                    'image' => $p->product_img,
                    'status' => $p->status ?? 'In Stock',
                ];
            }
        } else {
            foreach ($wishlistIds as $id => $item) {
                $wishlistItems[] = [
                    'id' => $id,
                    'name' => $item['name'] ?? 'Product Item #' . $id,
                    'price' => $item['price'] ?? 179.99,
                    'regular_price' => $item['regular_price'] ?? 199.99,
                    'image' => $item['image'] ?? 'sp1.jpg',
                    'status' => 'In Stock',
                ];
            }
        }

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Request $request, $id = null)
    {
        $productId = $id ?? $request->input('product_id', 1);
        $wishlist = session()->get('wishlist', []);

        $added = false;
        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
        } else {
            $product = Products::find($productId);
            $wishlist[$productId] = [
                'id' => $productId,
                'name' => $product ? $product->product_name : 'Computer Mac and Accessories',
                'price' => $product ? ($product->sale_price > 0 ? $product->sale_price : $product->regular_price) : 179.99,
                'regular_price' => $product ? $product->regular_price : 199.99,
                'image' => $product ? $product->product_img : 'sp1.jpg',
            ];
            $added = true;
        }

        session()->put('wishlist', $wishlist);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'added' => $added,
                'message' => $added ? 'Added to wishlist!' : 'Removed from wishlist!',
                'wishlist_count' => count($wishlist),
            ]);
        }

        return redirect()->back()->with('success', $added ? 'Added to wishlist!' : 'Removed from wishlist!');
    }
}
