<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\QuantityResource;
use App\Models\Box;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
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

    public function show()
    {
        $user = Auth::id();

        $order = Order::with(['user', 'quantities.product', 'quantities.box'])
            ->where('user_id', $user)
            ->where('status', 'pending')
            ->first();

        if ($order) {
            return new OrderResource($order);
        }

        return response()->json([
            'message' => 'There is no active order at the moment.'
        ], 404);
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

        $user = Auth::id();

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

    public function addBoxToOrder(Request $request)
    {
        $request->validate([
            'box_id' => 'required|exists:boxes,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $user = Auth::id();

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

        $box = Box::findOrFail($request->box_id);
        $totalPrice = $box->price * $request->quantity;

        $quantity = Quantity::create([
            'box_id' => $request->box_id,
            'order_id'   => $order->id,
            'quantity'   => $request->quantity,
        ]);

        $order->increment('price', $totalPrice);

        return response()->json([
            'message'  => 'box added and price updated',
            'order'    => new OrderResource($order->load(['quantities.box'])),
            'quantity' => new QuantityResource($quantity->load(['box'])),
        ]);
    }

    public function sendOrder(Request $request)
    {
        $request->validate([
            'address'      => 'required|string|max:255',
            'delivered_by' => 'required|date|after:today',
        ]);

        $user = 1;

        $order = Order::where('user_id', $user)
            ->where('status', 'pending')
            ->with('quantities')
            ->first();

        if (!$order) {
            return response()->json([
                'message' => 'There is no request being created to send.'
            ], 404);
        }

        if ($order->quantities->isEmpty()) {
            return response()->json([
                'message' => 'You cannot send an empty order without products.'
            ], 400);
        }

        $order->update([
            'address'      => $request->address,
            'delivered_by' => $request->delivered_by,
            'status'       => 'done',
        ]);

        return response()->json([
            'message' => 'The request has been sent successfully.',
            'order'   => new OrderResource($order->load(['quantities.product', 'quantities.box'])),
        ]);
    }
}
