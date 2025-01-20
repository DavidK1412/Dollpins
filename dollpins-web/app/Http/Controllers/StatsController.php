<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Charts\OrdersChart;

class StatsController extends Controller
{
    private OrdersChart $ordersChart;
    private OrderService $orderService;

    public function __construct(
        OrdersChart $ordersChart,
        OrderService $orderService
    ) {
        $this->ordersChart = $ordersChart;
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('panels.stats.index');
    }

    public function report(Request $request)
    {
        $validated = $request->validate([
            'reportType' => 'required|string|in:Pedidos,Ventas',
            'startDate' => 'nullable|date|required_if:reportType,Pedidos',
            'endDate' => 'nullable|date|required_if:reportType,Pedidos|after_or_equal:startDate',
         ]);

        $tipoReporte = $validated['reportType'];
        $startDate = $validated['startDate'];
        $endDate = $validated['endDate'];


        $orders = $this->orderService->getAllOrders();

        $resultadoPedidos = [];
        $totalesEnRango = [];
        $mesesEnRango = [];
        $conteoVentasMes = [];

        $pedidosEnRango = array_filter($orders->toArray(), function ($order) use ($startDate, $endDate) {
            $orderDate = strtotime($order['created_at']);
            $start = strtotime($startDate);
            $end = strtotime($endDate);
            return $orderDate >= $start && $orderDate <= $end;
        });


        if (empty($pedidosEnRango)) {
            return back()->with('error', 'No hay pedidos en el rango de fechas seleccionado.');
        }

        if ($tipoReporte === 'Pedidos') {
            $resultadoPedidos = [0, 0, 0];


            foreach ($orders as $order) {

                $orderDate = strtotime($order['created_at']);
                $start = strtotime($startDate);
                $end = strtotime($endDate);

                if ($orderDate >= $start && $orderDate <= $end) {

                    if ($order['status_id'] >= 1 && $order['status_id'] <= 3) {
                        $resultadoPedidos[$order['status_id'] - 1]++;
                    }
                }
            }

            return view('panels.stats.chart',[
                'chart' => $this->ordersChart->orderChart($startDate, $endDate, $resultadoPedidos),
                'chart2' => null
            ]);
        } elseif ($tipoReporte === 'Ventas') {

            $nombresMeses = [
                1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
                5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
                9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
            ];


            $totalesVentas = [];
            $conteoVentas = [];

            foreach ($pedidosEnRango as $order) {
                $orderDate = strtotime($order['created_at']);
                $start = strtotime($startDate);
                $end = strtotime($endDate);

                if ($orderDate >= $start && $orderDate <= $end) {
                    $mes = (int)date('n', $orderDate); // Obtener mes
                    $anio = (int)date('Y', $orderDate); // Obtener año
                    $clave = "$mes-$anio"; // Usamos una clave única por mes y año

                    // Inicializamos si no existe
                    if (!isset($totalesVentas[$clave])) {
                        $totalesVentas[$clave] = 0;
                        $conteoVentas[$clave] = 0; // Inicializamos el conteo
                    }

                    // Sumar al total de ventas
                    $totalesVentas[$clave] += (float)$order['total'];
                    // Incrementar el conteo de ventas para el mes
                    $conteoVentas[$clave]++;
                }
            }

            // Generar arrays de meses con año, totales y conteo
            foreach ($totalesVentas as $clave => $total) {
                [$mes, $anio] = explode('-', $clave);
                $mesesEnRango[] = ucfirst($nombresMeses[$mes]) . " $anio";
                $totalesEnRango[] = $total;
                $conteoVentasMes[] = $conteoVentas[$clave]; // Guardamos el conteo de ventas
            }

            $conteoVentasMes = array_values($conteoVentasMes);

            return view('panels.stats.chart',[
                'chart' => $this->ordersChart->sellChart($startDate, $endDate, $totalesEnRango, $mesesEnRango),
                'chart2' => $this->ordersChart->sellQuantityChart($startDate, $endDate, $conteoVentasMes, $mesesEnRango),
            ]);
        }


        return back()->with('success', 'Reporte generado correctamente.');
    }

}
