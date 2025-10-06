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
            'product' => new ProductResource($this->whenLoaded('product')),
            'box' => new BoxResource($this->whenLoaded('box')),
            'delivery' => new DeliveryResource($this->whenLoaded('delivery')),
            'delivered_by' => $this->delivered_by,
            'write_on_box' => $this->write_on_box,
        ];

    }
}
