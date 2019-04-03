@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Breadcrumbs::render('users.show', $user) }}
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{ $user->full_name }}</span>

                    <div class="float-right">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Editar</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('users.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
