<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDeleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'type' => 'products',
            'id' => (string) $this->getRouteKey(),
            'status' => 200,
            'message' => 'Product deleted successfully',
        ];
    }
}
