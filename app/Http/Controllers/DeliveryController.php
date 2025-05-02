<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::paginate(10);
        return DeliveryResource::collection($deliveries);
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
    public function store(DeliveryRequest $request)
    {
        $delivery = Delivery::create($request->validated());

        return response()->json([
            'message' => 'Delivery created successfully',
            'data' => new DeliveryResource($delivery)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $delivery = Delivery::findOrFail($id);
        return response()->json($delivery);
    }


    public function update(DeliveryRequest $request,  $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->update($request->validated());

        return response()->json([
            'message' => 'Delivery updated successfully',
            'data' => $delivery
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return response()->json([
            'message' => 'Delivery deleted successfully'
        ]);
    }
}
