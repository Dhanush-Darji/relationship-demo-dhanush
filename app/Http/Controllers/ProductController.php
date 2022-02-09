<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\Upsert;
use App\Http\Resources\Product\Collection as ProductCollection;
use App\Http\Resources\Product\Resource as ProductResource;
use App\Services\ProductService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponser;

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productService->collection($request->all());
        return $this->collection(new ProductCollection($products));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Upsert $request)
    {
        $product = $this->productService->store($request->all());
        return $this->success(new ProductResource($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->resource($id);
        return $this->resource(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $product = $this->productService->update($id, $request->all());
        return $this->success(new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->delete($id);
        return $this->success($product);
    }
}
