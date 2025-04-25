<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlavorResource;
use App\Models\Flavor;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavors =Flavor::latest()->paginate(6);
        return FlavorResource::collection($flavors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flavor $flavor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
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
    public function destroy( $id)
    {
         $flavor = Flavor::findOrFail($id);
        $flavor->delete();

        return response()->json([
            'message' => 'Flavor deleted successfully'
        ]);
    }
}
