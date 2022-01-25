<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'qty' => 5,
            'total' =>200000
        ];
    }
}
