<?php

namespace App\Charts;

use App\Models\TransportUsage;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MonthlyTransportUsagesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $result = TransportUsage::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();
        $data = [];
        $month = [];
        foreach ($result as $key => $value) {
            array_push($data, $value['data']);
            array_push($month, $value['month']);
        }
        // dd($data);
        return $this->chart
            ->barChart()
            ->setTitle('Data Penggunaan Kendaraan Per Bulan')
            ->setSubtitle('2023')
            ->addData('Peminjaman', $data)
            ->setXAxis($month);
    }
}
