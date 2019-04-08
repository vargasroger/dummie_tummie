@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('strings.sessions.title')</div>

                <div class="card-body">
                    @include('list_sessions')
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
