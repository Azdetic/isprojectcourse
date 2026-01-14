<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class MyProductController extends Controller
{
    public function index()
    {
        // Only show products created by the authenticated user
        $products = Product::where('user_id', Auth::id())->latest()->get();
        return view('my-products.index', compact('products'));
    }

    public function create()
    {
        return view('my-products.create');
    }

    public function store(Request $request, ProductService $productService)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productService->createProduct($validatedData);

        return redirect()->route('my-products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Check ownership
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('my-products.edit', compact('product'));
    }

    public function update(Request $request, ProductService $productService, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Check ownership
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $productService->updateProduct($validatedData, $product);

        return redirect()->route('my-products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Check ownership
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Optional: Delete the image from storage when the product is deleted
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('my-products.index')->with('success', 'Product deleted successfully.');
    }
}
