<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'size' => $this->size,
            'description' => $this->description,
            'category' => $this->category,
            'is_available' => $this->is_available,
            'quantity' => $this->quantity,
            'leave_color' => $this->leave_color,
            'purchased_date' => $this->purchased_date,
            'image' => $this->image,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'carts' => MyCartResource::collection($this->whenLoaded('carts')),
        ];
    }
}
