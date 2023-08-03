@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row d-flex flex-row">
                        <div class="col-lg-6 col-12">
                            {!! $chart->container() !!}
                        </div>
                        <div class="col-lg-6 col-12">
                            {!! $chartGas->container() !!}
                        </div>
                        <div class="col-lg-6 col-12">
                            {!! $chartService->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{$chart->cdn()}}"></script>
{{$chart->script()}}
<script src="{{$chartGas->cdn()}}"></script>
{{$chartGas->script()}}
<script src="{{$chartService->cdn()}}"></script>
{{$chartService->script()}}
@endsection
