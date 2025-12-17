<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $input['image'] = "/images/$profileImage";
        }

        // Set seller info
        $input['user_id'] = Auth::id();
        $input['seller_name'] = Auth::user()->name;

        Product::create($input);

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

    public function update(Request $request, $id)
    {
        $request->validate([
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

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $input['image'] = "/images/$profileImage";
        } else {
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('my-products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Check ownership
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();

        return redirect()->route('my-products.index')->with('success', 'Product deleted successfully.');
    }
}
