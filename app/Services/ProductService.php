<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Product;
use Str;

class ProductService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function collection($request)
    {
        $products = $this->product;
        $paginate = isset($request['paginate']) ? $request['paginate'] : env('PAGINATE');

        if (isset($request['search']) && $request['search'] != '') {
            $products->where('name', 'like', '%' . $request['search'] . '%')
                ->orWhere('description', 'like', '%' . $request['search'] . '%');
        }

        if ($paginate == -1) {
            $products = $products->get();
        } else {
            $products = $products->paginate($paginate);
        }

        return $products;
    }

    public function resource($id)
    {
        $product = $this->product->findOrFail($id);
        return $product;
    }

    public function store($inputs)
    {
        $inputs['slug'] = Str::slug($inputs['name']);
        $product = $this->product->create($inputs);

        return $product;
    }

    public function update($id, $inputs)
    {
        $product = $this->resource($id);
        $inputs['slug'] = Str::slug($inputs['name']);
        $product->update($inputs);

        return $product;
    }

    public function delete($id)
    {
        $product = $this->resource($id);
        $product = $product->delete();

        return $product;
    }
}
