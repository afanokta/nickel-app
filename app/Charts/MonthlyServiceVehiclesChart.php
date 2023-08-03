<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MonthlyServiceVehiclesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $result = DB::table('vehicle_maintains')
            ->selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();
        $data = [];
        $month = [];
        foreach ($result as $key => $value) {
            array_push($data, $value->data);
            array_push($month, $value->month);
        }

        return $this->chart
            ->barChart()
            ->setTitle('Jumlah Service Per bulan')
            ->setSubtitle('2023')
            ->addData('Service', $data)
            ->setXAxis($month);
    }
}
