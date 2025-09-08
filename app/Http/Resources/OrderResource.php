<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'subtotal' => $this->quantities->sum(function ($quantity) {
                return ($quantity->product?->price ?? 0) * $quantity->quantity;
            }),

            'discount' => $this->quantities->sum(function ($quantity) {
                if ($quantity->product && $quantity->product->offers) {
                    return $quantity->product->offers->sum(function ($offer) use ($quantity) {
                        return (($quantity->product->price ?? 0) * $quantity->quantity) * ($offer->discount_percentage / 100);
                    });
                }
                return 0;
            }),

            'total' => (
                $this->quantities->sum(function ($quantity) {
                    return ($quantity->product?->price ?? 0) * $quantity->quantity;
                })
            ) - (
                $this->quantities->sum(function ($quantity) {
                    if ($quantity->product && $quantity->product->offers) {
                        return $quantity->product->offers->sum(function ($offer) use ($quantity) {
                            return (($quantity->product->price ?? 0) * $quantity->quantity) * ($offer->discount_percentage / 100);
                        });
                    }
                    return 0;
                })
            ),

            'quantities'  => QuantityResource::collection(
                $this->whenLoaded('quantities', $this->quantities)
            ),

        ];
    }
}
