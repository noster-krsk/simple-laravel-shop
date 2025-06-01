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

    
}
