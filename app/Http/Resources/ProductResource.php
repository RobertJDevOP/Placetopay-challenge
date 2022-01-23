<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'type' => 'products',
            'id' => (string) $this->getRouteKey(),
            'attributes'=>[
                'product_name' => $this->product_name,
                'list_price' => $this->list_price,
                'url_product_image' => $this->url_product_image,
            ],
            'relationships' => New ProductCategoryResource($this->category),
            'links' => [
                'self' => route('api.v1.products.index' ,$this)
            ]
        ];
    }
}
