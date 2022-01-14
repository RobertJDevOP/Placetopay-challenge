<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderDetailFactory extends Factory
{
    protected $model = PurchaseOrderDetail::class;

    public function definition(): array
    {
        return [
            'purchase_order_id' => $this->faker->randomElement(PurchaseOrder::all())['id'],
            'product_id' =>$this->faker->randomElement(Product::all())['id'],
            'qty' => 5,
            'price' => 5 * 1200,
        ];
    }
}
