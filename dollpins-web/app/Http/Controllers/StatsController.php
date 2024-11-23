<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\EmployeeService;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Services\TransactionsService;
use App\Services\PayrollService;
use App\Services\CityService;

class StatsController
{
    protected $clientService;
    protected $employeeService;
    protected $productService;
    protected $orderService;
    protected $transactionsService;
    protected $payrollService;
    protected $cityService;

    public function __construct(
        ClientService $clientService,
        EmployeeService $employeeService,
        ProductService $productService,
        OrderService $orderService,
        TransactionsService $transactionsService,
        PayrollService $payrollService,
        CityService $cityService
    ) {
        $this->clientService = $clientService;
        $this->employeeService = $employeeService;
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->transactionsService = $transactionsService;
        $this->payrollService = $payrollService;
        $this->cityService = $cityService;
    }

    public function index()
    {
        return view('stats.index');
    }

    public function ordersStats()
    {
        $orders = $this->orderService->getAllOrders();
        return view('stats.orders', compact('orders'));
    }

    public function financialStats()
    {
        $transactions = $this->transactionsService->getAllTransactions();
        return view('stats.financial', compact('transactions'));
    }

    public function payrollStats()
    {
        $payrolls = $this->payrollService->getAll();
        return view('stats.payrolls', compact('payrolls'));
    }


}
