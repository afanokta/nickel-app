<?php

namespace App\Charts;

use App\Models\TransportUsage;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyGasVehiclesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $result = TransportUsage::selectRaw('year(created_at) year, monthname(created_at) month, sum(gas) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();
        $data = [];
        $month = [];
        foreach ($result as $key => $value) {
            array_push($data, $value['data']);
            array_push($month, $value['month']);
        }
        return $this->chart
            ->lineChart()
            ->setTitle('Data Penggunaan BBM kendaraan')
            ->setSubtitle('2023')
            ->addData('Total', $data)
            ->setXAxis($month);
    }
}
