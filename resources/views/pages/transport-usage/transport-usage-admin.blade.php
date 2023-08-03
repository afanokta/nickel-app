@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Data yang belum diproses') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($undone) == 0)
                            <p>Tidak Ada Data</p>
                        @endif
                        @foreach ($undone as $u)
                            <div class="card p-2 row d-ffex flex-row">
                                <div class="col-lg-6 col-12">
                                    <label class="form-label" for="need">Peminjam</label>
                                    <input class="form-control" type="text" name="peminjam" disabled
                                        value="{{ $u->user->name }}">
                                    <label class="form-label" for="driver">Driver</label>
                                    <input class="form-control" type="text" name="driver" disabled
                                        value="{{ $u->driver }}">
                                    <label class="form-label" for="kendaraan">Kendaraan</label>
                                    <input class="form-control" type="text" name="kendaraan" disabled
                                        value="{{ $u->vehicle->vehicle }} | id : {{ $u->vehicle->id }}">
                                </div>
                                <div class="col-lg-6 col-12">
                                    <label class="form-label" for="booking_date">Tanggal Pemesanan</label>
                                    <input class="form-control" type="text" name="booking_date" disabled
                                        value="{{ $u->booking_date }}">
                                    <label class="mt-2" for="penyetuju">Mengetahui :</label>
                                    <input class="form-control" type="text" name="penyetuju" disabled
                                        value="{{ $u->agree ? $u->agree->name : 'belum di set' }}">
                                        <a href="{{ route('transport-usage.show', ['id' => $u->id]) }}"
                                            class="btn btn-primary mt-2">
                                            EDIT
                                        </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">{{ __('Riwayat Peminjaman') }}</div>
                    {{-- RIWAYAT PEMINJAMAN --}}
                    @foreach ($history as $h)
                        <div class="card-body">
                            <div class="card p-2 row d-flex flex-row">
                                <div class="col-lg-6 col-12">
                                    <p>Peminjam : {{ $h->user->name }}</p>
                                    <p>Kendaraan : {{ $h->vehicle->vehicle }} | {{ $h->vehicle->id }}</p>
                                    <p>Driver : {{ $h->driver }}</p>
                                    <p>Penyetuju : {{ $h->agree->name }} | {{ $h->agree->role->role }}</p>
                                    <p>Tanggal : {{ $h->booking_date }}</p>
                                    @if ($h->gas != 0)
                                        <p>BBM : {{ $h->gas }}</p>
                                    @endif
                                    @switch($h->status)
                                        @case('disetujui')
                                            <p>Status : <span class="text-success fw-bold"> {{ 'DISETUJUI' }}</span></p>
                                        @break

                                        @case('tidak_disetujui')
                                            <p>Status : <span class="text-danger fw-bold"> {{ 'DITOLAK' }}</span></p>
                                        @break

                                        @case('diproses')
                                            <p>Status : <span class="text-primary fw-bold"> {{ 'DIPROSES' }}</span></p>
                                        @break

                                        @default
                                            <p>Status : <span class="text-warning fw-bold"> {{ 'MENUNGGU PERSETUJUAN' }}</span></p>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
