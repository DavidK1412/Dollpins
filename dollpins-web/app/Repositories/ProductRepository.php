<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->all();
    }

    public function findById($id)
    {
        return $this->product->find($id);
    }

    public function create($data)
    {
        return $this->product->create($data);
    }

    public function update($id, array $data)
    {
        return $this->product->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->product->where('id', $id)->update(['status' => 2]);
    }

}
