<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Dummie Tummie') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top {
                position: absolute;
                top: 18px;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .sub-title {
                font-size: 30px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if(config('locale.status') && count(config('locale.languages')) > 1)
                <div class="top links">
                    <a href="#" style="text-decoration: underline">{{ __('menus.language-picker.langs.'.app()->getLocale()) }}</a>

                    @foreach(array_keys(config('locale.languages')) as $lang)
                        @if($lang != app()->getLocale())
                            <a href="{{ '/lang/'.$lang }}" class="dropdown-item">@lang('menus.language-picker.langs.'.$lang)</a>
                        @endif
                    @endforeach
                </div>
            @endif
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">@lang('menus.pages.home')</a>
                    @else
                        <a href="{{ route('register') }}">@lang('menus.pages.register')</a>
                        <a href="{{ route('login') }}">@lang('menus.pages.login')</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Dummie Tummie') }}
                </div>
                <div class="sub-title m-b-md">
                    @lang('strings.pages.welcome.subtitle')
                </div>
            </div>
        </div>
    </body>
</html>
