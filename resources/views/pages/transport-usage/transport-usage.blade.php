@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Pemesanan Kendaraan') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="card p-2">
                            <form class="" action="{{ route('transport-usage.add') }}" method="POST">
                                @csrf
                                <label class="form-label" for="need">Keperluan</label>
                                <input class="form-control" type="text" name="need"
                                    placeholder="Kebutuhan Kendaraan..." required>
                                <label class="form-label" for="booking_date">Tanggal Peminjaman</label>
                                <input class="form-control" type="date" name="booking_date" required>
                                <label for="vehicle">Pilih Kendaraan</label>
                                <select class="form-select" name="vehicle" id="vehicle" required>
                                    @foreach ($vehicles as $v)
                                        <option value={{ $v->id }}>{{ $v->vehicle }} | angkutan {{ $v->type }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-primary mt-2" name="submit" value="PESAN">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">{{ __('Riwayat Peminjaman') }}</div>
                    {{-- RIWAYAT PEMINJAMAN --}}
                    @foreach ($history->vehicles as $h)
                        <div class="card-body">
                            <div class="card p-2 row d-flex flex-row">
                                <div class="col-lg-6 col-12">
                                    <p>Peminjam : {{ $history->name }}</p>
                                    <p>Kendaraan : {{ $h->vehicle }} | angkutan {{ $h->type }}</p>
                                    <p>Keperluan : {{ $h->pivot->need }}</p>
                                    <p>Driver : {{ $h->driver ? $h->driver : 'belum di set' }}</p>
                                    <p>Tanggal Pesan : {{ $h->pivot->booking_date }}</p>
                                    <p>Tanggal Update : {{ $h->pivot->updated_at }}</p>
                                    @if ($h->pivot->gas != 0)
                                    <p>BBM : {{ $h->pivot->gas }}</p>
                                    @endif
                                    @switch($h->pivot->status)
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
                                    @if ($h->pivot->is_complete)
                                        <p class="text-primary">SELESAI</p>
                                    @endif
                                </div>
                                @if ($h->pivot->gas == 0 && $h->pivot->status == 'disetujui')
                                    <form class="col-lg-6 col-12 d-flex flex-column justify-content-center gap-3"
                                        action="{{ route('transport-usage.update-BBM', ['id' => $h->pivot->id]) }}"
                                        method="POST">
                                        @csrf
                                        <label for="gas" class="fw-bold">Update Konsumsi BBM (Rp)</label>
                                        <input type="number" class="form-control" name="gas" id="gas"
                                            placeholder="100000" min="1">
                                        <input type="submit" class="btn btn-primary" name="agreement" value="UPDATE">
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
