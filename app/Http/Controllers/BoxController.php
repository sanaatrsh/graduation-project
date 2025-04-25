<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoxResource;
use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = Box::paginate(10);
        return BoxResource::collection($boxes);
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
        $box = Box::create($request->validated());

        return response()->json([
            'message' => 'Box created successfully',
            'data' => $box
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $box = Box::with(['user', 'order'])->findOrFail($id);

        return response()->json($box);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Box $box)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $box = Box::findOrFail($id);
        $box->update($request->validated());

        return response()->json([
            'message' => 'Box updated successfully',
            'data' => $box
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return response()->json([
            'message' => 'Box deleted successfully'
        ]);
    }
}
