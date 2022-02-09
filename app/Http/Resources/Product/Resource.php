<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\Collection as OrderCollection;

class Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,      
            'slug' => $this->slug,      
            'description' => $this->description,      
            'price' => $this->price,
            'quantity' => $this->quantity,
            // 'orders' => $this->orders,
            'orders' => new OrderCollection($this->whenLoaded('orders')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,    
        ];
    }
}
