<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        return view('pages.laporan');
    }
}
