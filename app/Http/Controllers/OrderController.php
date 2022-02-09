<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\Upsert;
use App\Http\Resources\Order\Collection as OrderCollection;
use App\Http\Resources\Order\Resource as OrderResource;
use App\Services\OrderService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponser;

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->collection($request->all());
        return $this->collection(new OrderCollection($orders));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Upsert $request)
    {
        $order = $this->orderService->store($request->all());
        return $this->resource(new OrderResource($order));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $order = $this->orderService->resource($id);
        return $this->resource(new OrderResource($order));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Upsert $request)
    {
        $order = $this->orderService->update($id, $request->all());
        return $this->resource(new OrderResource($order));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->orderService->delete($id);
        return $this->success($order);
    }
}
