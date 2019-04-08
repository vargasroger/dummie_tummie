@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('strings.dashboard.title')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">@lang('strings.chart.user')</div>

                <div class="card-body">
                    <chart fetch-url="{{ route('users.grafico') }}"></chart>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
