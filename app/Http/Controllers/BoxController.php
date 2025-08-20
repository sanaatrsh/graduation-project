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
        $event = request()->get('event');

        $boxes = Box::when($event, function ($q) use ($event) {
            $q->where('event', $event);
        })
            ->latest()
            ->paginate(15);

        return BoxResource::collection($boxes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BoxRequest $request)
    {
        $data = collect($request->validated())->except(['images'])->toArray();

        $box = box::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $box->addMedia($image)->toMediaCollection('boxs');
            }
        }

        return response()->json([
            'message' => 'Box created successfully',
            'data' => new BoxResource($box),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $box = Box::findOrFail($id);

        return new BoxResource($box);
    }

    public function update(BoxRequest $request, $id)
    {
        $box = Box::findOrFail($id);
        $data = collect($request->validated())->except(['images'])->toArray();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $box->addMedia($image)->toMediaCollection('boxs');
            }
        }

        $box->update($data);
        return response()->json([
            'message' => 'Box updated successfully',
            'data' => new BoxResource($box),
        ]);
    }


    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();
        $box->clearMediaCollection('boxs');

        return response()->json([
            'message' => 'Box deleted successfully'
        ]);
    }
}
