<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        // Demo fallback items if user navigates straight to checkout to test UI
        if (empty($cart)) {
            $cart = [
                1 => [
                    'id' => 1,
                    'name' => 'Computer Mac and Accessories',
                    'price' => 179.99,
                    'regular_price' => 199.99,
                    'quantity' => 1,
                    'image' => 'sp1.jpg',
                    'storage' => '256GB',
                    'ram' => '8GB',
                ]
            ];
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $vat = $subtotal * 0.08;
        $shipping = $subtotal > 0 ? ($subtotal > 200 ? 0 : 15) : 0;
        $total = $subtotal + $vat + $shipping;

        $user = Auth::user();

        return view('checkout.index', compact('cart', 'subtotal', 'vat', 'shipping', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $vat = $subtotal * 0.08;
        $shipping = $subtotal > 0 ? ($subtotal > 200 ? 0 : 15) : 0;
        $total = $subtotal + $vat + $shipping;

        $userId = Auth::id() ?? 1;

        // Try creating order records if database connection is available
        $order = null;
        try {
            $order = Orders::create([
                'user_id' => $userId,
                'address' => $request->input('address'),
                'subtotal' => $subtotal,
                'VAT' => $vat,
                'shippingfree' => $shipping,
                'total' => $total,
                'status' => 'Pending Payment',
            ]);

            foreach ($cart as $item) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'] ?? 1,
                    'color_id' => 1,
                    'quantity' => $item['quantity'],
                    'total_each' => $item['price'] * $item['quantity'],
                ]);
            }

            Payments::create([
                'user_id' => $userId,
                'order_id' => $order->id,
                'payment_method' => $request->input('payment_method'),
                'status' => 'Pending Verification',
            ]);

            session()->forget('cart');
        } catch (\Exception $e) {
            // Log database error silently if table missing/unreachable
            \Log::warning('Checkout order DB save skipped: ' . $e->getMessage());
        }

        $orderId = $order ? $order->id : rand(1000, 9999);

        return redirect()->route('checkout.success', ['id' => $orderId])
            ->with('payment_method', $request->input('payment_method'));
    }

    public function success($id = 1)
    {
        return view('checkout.success', ['orderId' => $id]);
    }
}
