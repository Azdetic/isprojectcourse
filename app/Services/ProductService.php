<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Handle the creation of a new product.
     *
     * @param array $validatedData
     * @return \App\Models\Product
     */
    public function createProduct(array $validatedData)
    {
        $imagePath = null;
        if (isset($validatedData['image'])) {
            // Store the image in 'storage/app/public/products'
            // The 'storage:link' command must be run to make this directory accessible
            $imagePath = $validatedData['image']->store('products', 'public');
        }

        $product = Product::create([
            'user_id' => Auth::id(),
            'seller_name' => Auth::user()->name,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category' => $validatedData['category'],
            'image' => $imagePath,
        ]);

        return $product;
    }

    /**
     * Handle the updating of an existing product.
     *
     * @param array $validatedData
     * @param \App\Models\Product $product
     * @return \App\Models\Product
     */
    public function updateProduct(array $validatedData, Product $product)
    {
        $imagePath = $product->image;
        if (isset($validatedData['image'])) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store the new image
            $imagePath = $validatedData['image']->store('products', 'public');
        }

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category' => $validatedData['category'],
            'image' => $imagePath,
        ]);

        return $product;
    }
}
