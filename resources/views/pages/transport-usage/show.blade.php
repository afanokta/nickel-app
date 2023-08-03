@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Detail Pemesanan Kendaraan') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('transport-usage.update-penyetuju', $data->id) }}"
                            class="card p-2 row d-flex flex-row" method="POST">
                            <div class="col-lg-6 col-12">
                                @csrf
                                <label class="form-label" for="need">Peminjam</label>
                                <input class="form-control" type="text" name="peminjam" disabled
                                    value="{{ $data->user->name }}">
                                <label class="form-label" for="kendaraan">Kendaraan</label>
                                <input class="form-control" type="text" name="kendaraan" disabled
                                    value="{{ $data->vehicle->vehicle }} | id : {{ $data->vehicle->id }}">
                            </div>
                            <div class="col-lg-6 col-12">
                                <label class="form-label" for="booking_date">Tanggal Pemesanan</label>
                                <input class="form-control" type="text" name="booking_date" disabled
                                    value="{{ $data->booking_date }}">
                                <label class="form-label" for="driver">Driver</label>
                                <input class="form-control" type="text" name="driver" value="{{ $data->driver }}"
                                    placeholder="driver" required>
                                <label for="penyetuju">Pilih Penyetuju</label>
                                <select name="penyetuju" id="" class="form-select" required>
                                    @foreach ($penyetuju as $p)
                                        @foreach ($p->users as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }} |
                                                {{ $p->role }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mt-4">SELESAI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
