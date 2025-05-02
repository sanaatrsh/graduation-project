<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoxRequest;
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
     * Store a newly created resource in storage.
     */
    public function store(BoxRequest $request)
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
        $box = Box::findOrFail($id);

        return response()->json($box);
    }

    public function update(BoxRequest $request, $id)
    {
        $box = Box::findOrFail($id);
        $box->update($request->validated());

        return response()->json([
            'message' => 'Box updated successfully',
            'data' => $box
        ]);
    }


    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return response()->json([
            'message' => 'Box deleted successfully'
        ]);
    }
}
