<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders = Order::with(['product', 'delivery', 'box'])->latest()->paginate(10);
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        return response()->json($order, 201);
    }

    public function show($id)
    {

        $order = Order::with(['product', 'box', 'delivery'])->findOrFail($id);
        return response()->json($order);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());

        return response()->json([
            'message' => 'order updated successfully',
            'data' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'order deleted successfully'
        ]);
    }
}
