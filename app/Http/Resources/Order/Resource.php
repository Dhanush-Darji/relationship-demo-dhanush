<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\Collection as ProductCollection;

class Resource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            'is_paid' => $this->is_paid,
            'quantity' => $this->quantity,
            // 'products' => $this->products,
            'products' => new ProductCollection($this->whenLoaded('products')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
