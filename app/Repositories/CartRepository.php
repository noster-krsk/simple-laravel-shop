<?php

namespace App\Repositories;

use App\Models\Carts;

class CartRepository
{
    public function getNewCarts()
    {
               return Carts::all();
    }
    
    public function getNewCartsLen()
    {
        return Carts::new()->get()->count();
    }
      public function update(array $data, int $id): Carts
    {
        $product =Carts::findOrFail($id);
        $product->update($data);
        return $product;
    }
   public function create(array $data): Carts
    {
        return Carts::create($data);
    }

}
