<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
trait ApiResponser
{
    protected function success($data, $code = 200)
    {
        return response()->json(['data' => $data], $code);
    }

    protected function error($message, $code = 400)
    {
        return response()->json(['message' => $message], $code);
    }

    private function resource(JsonResource $resource, $code = 200)
    {
        return $this->success($resource, $code);
    }

    private function collection(ResourceCollection $collection, $code = 200)
    {
        return $collection;
    }
}
