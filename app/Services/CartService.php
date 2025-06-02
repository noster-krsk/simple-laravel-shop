<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    protected $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function fetchNewCarts()
    {
        return $this->repository->getNewCarts();
    }

    
    public function fetchNewCartsLen()
    {
        return $this->repository->getNewCartsLen();
    }

    public function addOrder(array $data)
    {
        return $this->repository->create($data);
    }
    
    public function updateCarts(array $data,int $id)
    {
        return $this->repository->update($data,$id);
    }
}
