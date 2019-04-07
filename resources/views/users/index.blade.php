@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Breadcrumbs::render('users') }}
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>@lang('menus.users.main')</span>

                    <div class="float-right">
                        <a href="{{ route('users.create') }}" class="btn btn-secondary">@lang('labels.general.create_new')</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('users.list')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
