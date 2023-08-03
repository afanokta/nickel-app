<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyGasVehiclesChart;
use App\Charts\MonthlyServiceVehiclesChart;
use App\Charts\MonthlyTransportUsagesChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(MonthlyTransportUsagesChart $chart, MonthlyGasVehiclesChart $chartGas, MonthlyServiceVehiclesChart $chartService)
    {
        if (Auth::user()->role->role == 'admin') {
            return view('home', [
                'chart' => $chart->build(),
                'chartGas' => $chartGas->build(),
                'chartService' => $chartService->build(),
            ]);
        }
        return redirect()->route('transport-usage.riwayat');
    }
}
