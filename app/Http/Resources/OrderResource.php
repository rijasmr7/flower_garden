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
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'orderable_type' => $this->orderable_type,
            'orderable_id' => $this->orderable_id,
            'orderable' => $this->whenLoaded('orderable', function () {
                return $this->orderable ? $this->orderable->toArray() : null;
            }),
            'ordered_date' => $this->ordered_date ? $this->ordered_date->toDateTimeString() : null,
            'delivery_date' => $this->delivery_date ? $this->delivery_date->toDateTimeString() : null,
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
