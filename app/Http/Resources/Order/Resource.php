<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\Collection as ProductCollection;
use App\Traits\ResourceFilterable;

class Resource extends JsonResource
{
    use ResourceFilterable;
    protected $model = 'Order';
   
    public function toArray($request)
    {
        $data = $this->fields();
        $data['quantity'] = $this->quantity;
        $data['products'] = new ProductCollection($this->whenLoaded('products'));
        
        return $data;
    }
}
