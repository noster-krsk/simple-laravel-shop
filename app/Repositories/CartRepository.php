<?php

namespace App\Repositories;

use App\Models\Carts;

class CartRepository
{
    public function getNewCarts()
    {
        return Carts::new()->get()->count();
    }

   
}
