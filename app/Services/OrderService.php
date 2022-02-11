<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;


class OrderService
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function collection($request)
    {
        $orders = $this->order->getQB();
        $paginate = isset($request['paginate']) ? $request['paginate'] : config('site.paginate');

        if ($paginate == -1) {
            $orders = $orders->get();
        } else {
            $orders = $orders->paginate($paginate);
        }

        return $orders;
    }

    public function resource($id)
    {
        $order = $this->order->getQB()->findOrFail($id);
        return $order;
    }

    public function store($inputs)
    {
        $total = 0;
        $sub_total = 0;

        $order = $this->order->create([
            'sub_total' => $sub_total,
            'total' => $total
        ]);

        foreach ($inputs as $cart) {
            $product = Product::find($cart['product_id']);
            $sub_total = $sub_total + ($product->price * $cart['quantity']);

            $order->products()->attach($cart['product_id'], [
                'quantity' => $cart['quantity']
            ]);
        }

        $order->update([
            'sub_total' => $sub_total,
            'total' => $sub_total + 100
        ]);

        return $order;
    }

    public function update($id, $inputs)
    {
        $order = $this->resource($id);

        $order->update([
            'sub_total' => $inputs['sub_total'],
            'total' => $inputs['total']
        ]);

        $product = Product::find($inputs['product_id']);
        $product->orders()->updateExistingPivot($order->id, ['quantity' => $inputs['quantity']]);

        return $order;
    }

    public function delete($id)
    {
        $order = $this->resource($id);
        $order->products()->detach();
        $order = $order->delete();

        return $order;
    }
}
