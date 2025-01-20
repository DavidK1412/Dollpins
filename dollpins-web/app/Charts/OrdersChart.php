<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class OrdersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function orderChart($startDate, $endDate, $data)
    {
        return $this->chart->donutChart()
            ->setTitle('Estado de los pedidos de la fecha')
            ->setSubtitle('Rango de fechas seleccionado: ' . $startDate . ' - ' . $endDate)
            ->addData(
                $data
            )
            ->setLabels(
                ['Pendientes', 'Enviados', 'Completado']
            );
    }

    public function sellChart($startDate, $endDate, $data, $months)
    {
        return $this->chart->pieChart()
            ->setTitle('Ventas a la fecha (valores mensuales, en pesos)')
            ->setSubtitle('Rango de fechas seleccionado: ' . $startDate . ' - ' . $endDate)
            ->addData(
                $data
            )
            ->setLabels(
                $months
            );
    }

    public function sellQuantityChart($startDate, $endDate, $data, $months)
    {
        return $this->chart->donutChart()
            ->setTitle('Cantidad de ventas por mes')
            ->setSubtitle('Rango de fechas seleccionado: ' . $startDate . ' - ' . $endDate)
            ->addData(
                $data
            )
            ->setLabels(
                $months
            );

    }

}
