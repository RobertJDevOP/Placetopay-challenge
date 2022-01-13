<?php

namespace App\Repositories\Eloquent;


use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function find($id){
        return Product::find($id);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Product::all();
    }

    public function create($data){
        return Product::create($data);
    }

    public function update($id, $data){
        return $this->find($id)->update($data);
    }

    public function delete($id){
        Product::destroy($id);
    }
}
