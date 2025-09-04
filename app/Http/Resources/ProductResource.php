<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'category'    => $this->category?->name,
            'brand'       => $this->brand?->name,
            'price'       => $this->price,
            'description' => $this->description,
            'trending'    => $this->trending,

            'offers' => $this->whenLoaded('offers', function () {
                return $this->offers->map(function ($offer) {
                    $offer->product_price = $this->price;
                    return new OfferResource($offer);
                });
            }),


            'image_urls'  => $this->getMedia('products')->map(function ($media) {
                return url($media->getUrl());
            }),
        ];
    }
}
