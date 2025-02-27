<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $products = Product::with('user')->get();
        return Inertia::render('Home', ['products' => $products]);
    }

    public function create()
    {
        return Inertia::render('ProductForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $request->user()->products()->create($request->only('name', 'description', 'price'));

        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return Inertia::render('ProductForm', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $product->update($request->only('name', 'description', 'price'));

        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
    }

    public function dashboard()
    {
        $products = Product::where('user_id', auth()->id())->get();
        return Inertia::render('Dashboard', ['products' => $products]);
    }
}
