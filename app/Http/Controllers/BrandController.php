<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return BrandResource::collection(Brand::all());
    }

    public function store(BrandRequest $request)
    {
        $data = collect($request->validated())->except(['image'])->toArray();
        $brand = Brand::create($data);
        if ($request->hasFile('image')) {
            $brand->addMedia($request->file('image'))->toMediaCollection('brands');
        }
        return new BrandResource($brand);
    }

    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($request->validated());
        if ($request->hasFile('image')) {
            $brand->addMedia($request->file('image'))->toMediaCollection('brands');
        }
        return new BrandResource($brand);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json([
            'message' => 'Brand deleted successfully'
        ]);
    }
}
