<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('products');
            $fullUrl = $product->getFirstMediaUrl('products');
            $imagePath = str_replace(url('/'), '', $fullUrl);
        }

        return response()->json([
            'message' => 'Product created successfully',
            'image_url' => $product->getFirstMediaUrl('products'),
            'data' => $product,
        ], 201);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validated();

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->clearMediaCollection('products');
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
