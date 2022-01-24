<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray($request): array
    {
      return [
            'data' => ProductResource::collection($this->collection),
            'links' => [
                'self' => route ('api.v1.products.index')
            ],
            'meta' => [
                'products_count' => $this->collection->count()
            ]
      ];
    }
}
