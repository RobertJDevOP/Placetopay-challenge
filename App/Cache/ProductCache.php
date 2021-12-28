<?php

namespace App\Cache;

use App\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;

class ProductCache extends BaseCache implements ProductRepositoryInterface
{
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository, 'product');
    }

    public function all()
    {
        return $this->cache::remember($this->key, self::TTL, function() {
            return $this->repository->all();
        });
    }

}
