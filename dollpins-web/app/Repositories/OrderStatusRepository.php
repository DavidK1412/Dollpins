<?php

namespace App\Repositories;

use App\Models\OrderStatus;

class OrderStatusRepository
{
    protected OrderStatus $orderStatus;

    public function __construct(OrderStatus $orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    public function all()
    {
        return $this->orderStatus->all();
    }

    public function create(array $data)
    {
        return $this->orderStatus->create($data);
    }

    public function findById($id)
    {
        return $this->orderStatus->find($id);
    }

    public function update($id, array $data)
    {
        return $this->orderStatus->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->orderStatus->where('id', $id)->update(['status' => 2]);
    }

    public function findByName($name)
    {
        return $this->orderStatus->where('name', $name)->first();
    }

}
