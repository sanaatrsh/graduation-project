<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $price = $this->product_price ?? null;

        $discountedPrice = $price
            ? $price - ($price * ($this->discount_percentage / 100))
            : null;

        return [
            'discount_percentage' => $this->discount_percentage,
            'start_date'          => $this->start_date,
            'end_date'            => $this->end_date,
            'discounted_price'    => $discountedPrice,
            'duration'            => now()->lessThan($this->end_date)
                ? now()->diffForHumans($this->end_date, [
                    'parts' => 2,
                    'short' => true,
                    'syntax' => \Carbon\Carbon::DIFF_ABSOLUTE
                ])
                : 'expired',
        ];
    }
}
