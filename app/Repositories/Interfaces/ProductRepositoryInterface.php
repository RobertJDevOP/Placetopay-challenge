<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function find($id);

    public function getAll();

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}
