<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\QuantityResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'quantities.product', 'quantities.box'])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return new OrderResource($order->load(['user', 'quantities.product', 'quantities.box']));
    }


    public function show($id)
    {
        $order = Order::with(['user', 'quantities.product', 'quantities.box'])
            ->findOrFail($id);

        return new OrderResource($order);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());

        return new OrderResource($order->load(['user', 'quantities.product', 'quantities.box']));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'order deleted successfully'
        ]);
    }

    public function addProductToOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $user = 1;

        $order = Order::where('user_id', $user)
            ->where('status', 'pending')
            ->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => $user,
                'status'  => 'pending',
                'price'   => 0,
            ]);
        }

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        $quantity = Quantity::create([
            'product_id' => $request->product_id,
            'order_id'   => $order->id,
            'quantity'   => $request->quantity,
        ]);

        $order->increment('price', $totalPrice);

        return response()->json([
            'message'  => 'Product added and price updated',
            'order'    => new OrderResource($order->load(['quantities.product'])),
            'quantity' => new QuantityResource($quantity->load(['product'])),
        ]);
    }
}
