@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header">{{ __('Riwayat Persetujuan') }}</div>

                    {{-- RIWAYAT PERSETUJUAN --}}
                    <div class="card-body">
                        @foreach ($data as $f)
                            <div class="card p-2 row d-flex flex-row my-2">
                                <div class="col-lg-6 col-12">
                                    <p>Peminjam : {{ $f->user->name }} | {{ $f->user->role->role }}</p>
                                    <p>Kendaraan : {{ $f->vehicle->vehicle }}</p>
                                    <p>Tanggal Pesan : {{ $f->booking_date }}</p>
                                    <p>Tanggal Update : {{ $f->updated_at }}</p>
                                    @if ($f->status == 'tidak_disetujui')
                                        <p>Status : <span class="text-danger fw-bold"> {{ 'DITOLAK' }}</span></p>
                                    @else
                                        <p>Status : <span class="text-success fw-bold"> {{ 'DISETUJUI' }}</span></p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
