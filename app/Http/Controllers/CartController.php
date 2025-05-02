<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with(['user', 'order'])->latest()->paginate(10);
        return CartResource::collection($carts);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        $cart = Cart::create($request->validated());

        return response()->json([
            'message' => 'Cart created successfully',
            'data' => $cart
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cart = Cart::with(['user', 'order'])->findOrFail($id);

        return response()->json($cart);
    }


    public function update(CartRequest $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->validated());

        return response()->json([
            'message' => 'Cart updated successfully',
            'data' => $cart
        ]);
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json([
            'message' => 'Cart deleted successfully'
        ]);
    }
}
