<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\TransportUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class AgreementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $finish = $user->agreements()->whereNotNull('is_agree')->get();
        $undone = $user->agreements()->whereNull('is_agree')->get();
        // dd($undone->get());
        $data = [
            'finish' => $finish,
            'undone' => $undone,
        ];
        if($user->role->role == 'admin') {
            $data = TransportUsage::all();
            // dd($data);
            return view('/pages/persetujuan-admin', ['data' =>$data]);
        }
        return view('/pages/persetujuan', $data);
    }

    public function agree(Request $request, $id) {
        $is_agree = false;
        if ($request['agreement'] != 'TOLAK') {
            $is_agree = true;
        };
        $tu = TransportUsage::find($id);
        $tu->update([
            'is_agree' => $is_agree,
            'status' => $is_agree ? 'disetujui' : 'tidak_disetujui',
            'is_complete' => !$is_agree
        ]);
        if ($is_agree) {
            $tu->vehicle->update([
                'status' => 'tidak_tersedia'
            ]);
        }
        return redirect()->back()->with('status', 'sukses memperbarui');
    }
}
