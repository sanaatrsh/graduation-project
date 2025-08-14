<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(15);
        return ProductResource::collection($products);
    }

    public function productByCategory(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $category->id)->latest()->paginate(10);
        return ProductResource::collection($products);
    }

    public function trendingIndex()
    {
        $products = Product::where('trending', 1)->with(['category', 'brand'])->latest()->paginate(15);
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return new ProductResource($product);
    }

    public function create(ProductRequest $request)
    {
        $data = collect($request->validated())->except(['image', 'discount_percentage', 'start_date', 'end_date'])->toArray();

        $product = Product::create($data);

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('products');
        }

        if ($request->filled('discount_percentage') && $request->filled('start_date') && $request->filled('end_date')) {
            $product->offers()->create([
                'discount_percentage' => $request->discount_percentage,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        }

        $product->load(['category', 'brand', 'offers']);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => new ProductResource($product),
        ], 201);
    }


    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = collect($request->validated())->except(['image', 'discount_percentage', 'start_date', 'end_date'])->toArray();

        $product->update($data);

        if ($request->filled('discount_percentage') && $request->filled('start_date') && $request->filled('end_date')) {
            $product->offers()->updateOrCreate(
                [],
                [
                    'discount_percentage' => $request->discount_percentage,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]
            );
        } else {
            $product->offer()?->delete();
        }
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('products');
        }
        $product->load(['category', 'brand', 'offers']);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => new ProductResource($product),
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
