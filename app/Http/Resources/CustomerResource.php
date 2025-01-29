<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'address' => [
                'address' => $this->address,
                'city' => $this->city,
                'province' => $this->province,
                'district' => $this->district,
                'postal_code' => $this->postal_code,
            ],
            'orders' => OrderResource::collection($this->whenLoaded('orders')), 
            'inquiries' => InquiryResource::collection($this->whenLoaded('inquiries')),
            'cart' => new MyCartResource($this->whenLoaded('carts')),
            'wishlists' => WishlistResource::collection($this->whenLoaded('wishlists')),
            'gardenings' => GardeningResource::collection($this->whenLoaded('gardenings')),
        ];
    }
}
