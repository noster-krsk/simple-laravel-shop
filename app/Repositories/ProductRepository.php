<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function find(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function edit(array $data, int $id): Product
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function getAll(): \Illuminate\Support\Collection
    {
        return Product::with('category')->get();
    }

    public function delete($id): void
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
