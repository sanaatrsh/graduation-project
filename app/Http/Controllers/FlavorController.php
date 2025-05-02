<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlavorRequest;
use App\Http\Resources\FlavorResource;
use App\Models\Flavor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavors = Flavor::latest()->paginate(6);
        return FlavorResource::collection($flavors);
    }

    public function store(FlavorRequest $request)
    {
        $flavor = Flavor::create($request->validated());

        return response()->json([
            'message' => 'Flavor created successfully',
            'data' => $flavor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $flavor = Flavor::findOrFail($id);
        return response()->json($flavor);
    }

    public function update(FlavorRequest $request, $id)
    {
        $flavor = Flavor::findOrFail($id);
        $flavor->update($request->validated());

        return response()->json([
            'message' => 'Flavor updated successfully',
            'data' => $flavor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $flavor = Flavor::findOrFail($id);
        $flavor->delete();

        return response()->json([
            'message' => 'Flavor deleted successfully'
        ]);
    }
}
