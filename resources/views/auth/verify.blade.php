@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('strings.emails.auth.verify_your_email')</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">@lang('strings.emails.auth.verification_link')
                        </div>
                    @endif

                    @lang('strings.emails.auth.check_your_email')

                    @lang('strings.emails.auth.if_did_not_receive') , <a href="{{ route('verification.resend') }}">@lang('strings.emails.auth.request_another')</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
