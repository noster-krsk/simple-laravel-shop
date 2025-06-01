<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addProduct(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateProduct(array $data,int $id)
    {
        return $this->repository->edit($data,$id);
    }
  
    public function getAllProducts(): \Illuminate\Support\Collection
    {
        return $this->repository->getAll();
    }
    public function deleteById($id): void
    {
        $this->repository->delete($id);
    }
}
