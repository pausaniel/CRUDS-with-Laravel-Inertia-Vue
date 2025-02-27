<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return Inertia::render('Cart', ['cartItems' => $cartItems]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        $cart = Cart::firstOrCreate(
            ['user_id' => $request->user()->id, 'product_id' => $product->id],
            ['quantity' => 1]
        );

        if (!$cart->wasRecentlyCreated) {
            $cart->increment('quantity');
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
}
