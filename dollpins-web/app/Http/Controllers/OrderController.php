<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\MailService;
use App\Services\OrderService;
use App\Services\EmployeeService;
use App\Services\ClientService;
use App\Services\ProductService;

class OrderController extends Controller
{
    protected $orderService;
    protected $mailService;
    protected $employeeService;
    protected $clientService;
    protected $productService;

    public function __construct(
        OrderService $orderService,
        MailService $mailService,
        EmployeeService $employeeService,
        ClientService $clientService,
        ProductService $productService
    ) {
        $this->orderService = $orderService;
        $this->mailService = $mailService;
        $this->employeeService = $employeeService;
        $this->clientService = $clientService;
        $this->productService = $productService;
    }

    public function index($filter)
    {
        if ($filter === '') {
            $filter = 'Pendiente';
        }
        $orders = $this->orderService->getByStatus($filter);

        return view('panels.orders.index', compact('orders', 'filter'));
    }

    public function showCreateForm()
    {
        $clients = $this->clientService->getAllClients();

        return view('panels.orders.create', compact('clients'));
    }

    public function createFirstStep(Request $request)
    {
        $data = $request->validate(
            [
                'client_id' => 'required|string',
            ]
        );
        $employee = $this->employeeService->getEmployeeByUserId(auth()->user()->id);
        $data['employee_id'] = $employee->id;
        $data['status_id'] = 0;
        $data['sub_total'] = 0;
        $data['total'] = 0;
        $data['extras'] = 0;
        $data['discount'] = 0;
        $data['delivery_address'] = '';
        $order = $this->orderService->createOrder($data);

        return redirect()->route('orders.create.second', ['order' => $order->id]);
    }

    public function showSecondStep($order)
    {
        $order = $this->orderService->getOrder($order);
        $products = $this->productService->getStockProducts();

        return view('panels.orders.create-second', compact('order', 'products'));
    }

    public function mutateSecondStep(Request $request, $order)
    {
        $data = $request->validate(
            [
                'product_id' => 'required',
                'quantity' => 'required|integer',
            ]
        );
        $product = $this->productService->getProductById($data['product_id']);
        $product->stock -= $data['quantity'];
        $order = $this->orderService->getOrder($order);
        // Remove entrie 'products' of order object
        unset($order['products']);
        $this->orderService->addProduct($order->id, $product->id, $data['quantity'], $product->price * $data['quantity']);
        $order->sub_total += $product->price * $data['quantity'];
        $product->save();
        $order->save();

        return redirect()->route('orders.create.second', ['order' => $order->id]);
    }

    public function showFinalStep($order)
    {
        $order = $this->orderService->getOrder($order);

        return view('panels.orders.create-final', compact('order'));
    }

    public function saveOrder(Request $request, $order)
    {
        $data = $request->validate(
            [
                'delivery_address' => 'required',
                'extras' => 'required|numeric',
                'discount' => 'required|numeric',
            ]
        );
        $order = $this->orderService->getOrder($order);
        $order->delivery_address = $data['delivery_address'];
        $order->extras = $data['extras'];
        $order->discount = $data['discount'];
        $order->total = $order->sub_total + $data['extras'] - $data['discount'];
        $order->status_id = 1;

        $this->mailService->send(
            $order->client->mail,
            '¡Gracias por tu compra!',
            'emails.order',
            ['order' => $order]
        );

        unset($order['products']);
        $order->save();

        return redirect()->route('orders.index')->with(
            'success',
            'Orden creada exitosamente.'
        );
    }

    public function showOrder($order)
    {
        $order = $this->orderService->getOrder($order);

        return view('panels.orders.show', compact('order'));
    }

    public function upgradeOrderStatus($order)
    {
        $order = $this->orderService->getOrder($order);
        $order->status_id += 1;
        unset($order['products']);
        $order->save();
        $message = $order->status_id === 2 ? 'Enviado' : 'Finalizado';

        return redirect()->route('orders.index', [
            'filter' => $message,
        ])->with(
            'success',
            'Orden '.$message.' exitosamente.'
        );
    }

    public function trackOrder($order)
    {
        $order = $this->orderService->getOrder($order);

        return view('panels.orders.track', compact('order'));
    }

}
