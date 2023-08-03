@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('LAPORAN') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card p-2 mt-2">
                            <div>
                                <form action="{{route('home')}}" method="GET">
                                    Laporan Penggunaan Kendaraan Bulanan
                                    <label for="month" class="form-label">Bulan</label>
                                    <input type="num" class="form-control" placeholder="12" value="8" name="month">
                                    <label for="year" class="form-label">Tahun</label>
                                    <input type="num" class="form-control" placeholder="2023" value="2023" name="year">
                                    <button type="submit" class="btn btn-success mt-2">Unduh Laporan</button>
                                </form>
                            </div>
                        </div>
                        <div class="card p-2 mt-2">
                            <div>
                                <form action="{{route('home')}}" method="GET">
                                    Laporan Service Kendaraan Bulanan
                                    <label for="month" class="form-label">Bulan</label>
                                    <input type="num" class="form-control" placeholder="12" value="8" name="month">
                                    <label for="year" class="form-label">Tahun</label>
                                    <input type="num" class="form-control" placeholder="2023" value="2023" name="year">
                                    <button type="submit" class="btn btn-success mt-2">Unduh Laporan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
