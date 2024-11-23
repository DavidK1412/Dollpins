<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use App\Repositories\OrderProductsRepository;
use Illuminate\Support\Str;

class OrderService
{
    private $orderRepository;
    private $orderStatusRepository;
    private $orderProductsRepository;

    public function __construct(OrderRepository $orderRepository, OrderStatusRepository $orderStatusRepository, OrderProductsRepository $orderProductsRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->orderProductsRepository = $orderProductsRepository;
    }

    public function getOrder($id)
    {
        $order = $this->orderRepository->findById($id);
        $order->products = $this->orderProductsRepository->findByOrderId($id);

        return $order;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->all();
    }

    public function createOrder($data)
    {
        $data['id'] = Str::uuid();

        return $this->orderRepository->createOrder($data);
    }

    public function updateOrder($id, $data)
    {
        return $this->orderRepository->updateOrder($id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->orderRepository->deleteOrder($id);
    }

    public function getByStatus($status)
    {
        $status_id = $this->orderStatusRepository->findByName($status)->id;
        return $this->orderRepository->getByStatus($status_id);
    }

    public function addProduct($order_id, $product_id, $quantity, $price)
    {
        $data = [
            'id' => Str::uuid(),
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price
        ];
    }
}
