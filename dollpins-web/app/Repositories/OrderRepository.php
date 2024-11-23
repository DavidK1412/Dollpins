<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function all()
    {
        return $this->order->all();
    }

    public function createOrder(array $data)
    {
        return $this->order->create($data);
    }

    public function findById($id)
    {
        return $this->order->find($id);
    }

    public function update($id, array $data)
    {
        return $this->order->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->order->where('id', $id)->update(['status' => 2]);
    }

    public function getByStatus($status_id)
    {
        return $this->order->where('status_id', $status_id)->get();
    }

}
