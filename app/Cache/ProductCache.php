<?php

namespace App\Cache;

use App\Contracts\ProductRepositoryInterface;
use App\Repositories\UserRepositories;

class ProductCache extends BaseCache implements ProductRepositoryInterface
{
    public function __construct(UserRepositories $userRepositories)
    {
        parent::__construct($userRepositories, 'product');
    }

    public function all()
    {
        return $this->cache::remember($this->key, self::TTL, function() {
            return $this->repository->all();
        });
    }

}
