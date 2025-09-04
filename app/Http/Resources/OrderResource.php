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
            'delivered_by' => $this->delivered_by,
            'price' => $this->price,
            'address' => $this->address,
            'status' => $this->status,
            'quantities'  => QuantityResource::collection(
                $this->whenLoaded('quantities', $this->quantities)
            ),

            'created_at' => $this->created_at,
        ];
    }
}
