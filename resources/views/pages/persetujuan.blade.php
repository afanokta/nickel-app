@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Persetujuan') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card p-2 row d-flex flex-row">
                            @if (count($undone) == 0)
                                <p>Tidak ada pengajuan persetujuan</p>
                            @endif
                            @foreach ($undone as $u)
                                <div class="col-lg-6 col-12">
                                    <p>Peminjam : {{ $u->user->name }}</p>
                                    <p>Kendaraan : {{ $u->vehicle->vehicle }}</p>
                                    <p>Tanggal Pesan : {{ $u->booking_date }}</p>
                                </div>
                                <form class="col-lg-6 col-12 d-flex flex-column justify-content-center gap-3"
                                    action="{{ route('persetujuan.terima', ['id' => $u->id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="submit" class="btn btn-success" name="agreement" value="TERIMA">
                                    <input type="submit" class="btn btn-danger" name="agreement" value="TOLAK">
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">{{ __('Riwayat Persetujuan') }}</div>

                    {{-- RIWAYAT PERSETUJUAN --}}
                    <div class="card-body">
                        @foreach ($finish as $f)
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
