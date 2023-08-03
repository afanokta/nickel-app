<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Role;
use App\Models\TransportUsage;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportUsageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicles = Vehicle::all()->where('status', 'tersedia');
        if (Auth::user()->role->role == 'admin') {
            $bookingHistory = TransportUsage::orderBy('id', 'desc')->where('status', '!=', 'diproses')->get();
            $undone = TransportUsage::where('status', 'diproses')->get();
            // dd($undone->first()->agree()->get());
            // dd($undone->first()->agree()->get());
            return view('pages.transport-usage.transport-usage-admin', [
                'vehicles' => $vehicles,
                'history' => $bookingHistory,
                'undone' => $undone,
            ]);
        }
        $bookingHistory = Auth::user();
        return view('pages.transport-usage.transport-usage', [
            'vehicles' => $vehicles,
            'history' => $bookingHistory,
        ]);
    }

    function create(Request $req)
    {
        $exist = Auth::user()->vehicles()->wherePivot('gas', 0)->wherePivot('is_complete', false)->get();
        if(count($exist) > 0){
        return redirect()
            ->back()
            ->with('error', 'Pemesanan Anda Sebelumnya Masih Belum Selesai!');
        }
        Auth::user()
            ->vehicles()
            ->attach($req['vehicle'], [
                'need' => $req['need'],
                'booking_date' => $req['booking_date'],
                'status' => 'diproses',
                'gas' => 0,
            ]);
        return redirect()
            ->back()
            ->with('status', 'sukses menambahkan');
    }

    function bbm(Request $req, $id)
    {
        $tu = TransportUsage::find($id);
        $tu->update([
            'gas' => $req['gas'],
            'is_complete' => true
        ]);
        return redirect()
            ->back()
            ->with('status', 'sukses mengubah BBM');
    }

    function show($id)
    {
        $tu = TransportUsage::find($id);
        $penyetuju = Role::all()
            ->where('level', '>=', $tu->user->role->level + 2)
            ->where('role', '!=', 'admin');
        // dd($penyetuju->first()->users->first()->name);
        $data = [
            'data' => $tu,
            'penyetuju' => $penyetuju,
        ];
        return view('pages.transport-usage.show', $data);
    }

    function add_driver(Request $req, $id) {
        // dd($req['driver']);
        $old = TransportUsage::find($id);
        $old->update([
            'driver' => $req['driver']
        ]);
        return redirect()->back()->with('status', 'sukses menambah driver');
    }

    function update_penyetuju(Request $req, $id) {
        $tu = TransportUsage::find($id)
        ->update([
            'driver' => $req['driver'],
            'agree_id' => $req['penyetuju'],
            'status' => 'menunggu_persetujuan'
        ]);
        return redirect()->route('transport-usage.riwayat')->with('status', 'sukses menambah penyetuju');
    }
}
