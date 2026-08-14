<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $vat = $subtotal * 0.08; // 8% VAT
        $shipping = $subtotal > 0 ? ($subtotal > 200 ? 0 : 15) : 0;
        $total = $subtotal + $vat + $shipping;

        return view('cart.index', compact('cart', 'subtotal', 'vat', 'shipping', 'total'));
    }

    public function add(Request $request, $id = null)
    {
        $productId = $id ?? $request->input('product_id');
        $quantity = (int) ($request->input('quantity', 1));
        
        $product = Products::find($productId);

        $cart = session()->get('cart', []);

        if ($product) {
            $price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'price' => $price,
                    'regular_price' => $product->regular_price,
                    'quantity' => $quantity,
                    'image' => $product->product_img,
                    'storage' => $product->storage ?? 'Default',
                    'ram' => $product->RAM ?? 'Default',
                ];
            }
        } else {
            // Demo fallback item if adding demo product before DB seeding
            $demoId = $productId ?? 1;
            if (isset($cart[$demoId])) {
                $cart[$demoId]['quantity'] += $quantity;
            } else {
                $cart[$demoId] = [
                    'id' => $demoId,
                    'name' => 'Computer Mac and Accessories',
                    'price' => 179.99,
                    'regular_price' => 199.99,
                    'quantity' => $quantity,
                    'image' => 'sp1.jpg',
                    'storage' => '256GB',
                    'ram' => '8GB',
                ];
            }
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id = null)
    {
        $productId = $id ?? $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'cart' => $cart,
            ]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove(Request $request, $id = null)
    {
        $productId = $id ?? $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart!',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
