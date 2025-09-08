<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'event' => $this->event,
            'price' => $this->price,

            'image_urls' => $this->getMedia('boxs')->map(function ($media) {
                return parse_url($media->getUrl(), PHP_URL_PATH);
            }),
        ];
    }
}
