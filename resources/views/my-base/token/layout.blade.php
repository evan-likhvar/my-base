<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="uk-container">
    <nav class="uk-navbar uk-navbar-container uk-navbar-transparent" uk-navbar>
        <div class="uk-navbar-left">

            @include(config('site-settings.theme-views-base').'.includes.main-menu-links.main-menu-links')

        </div>
        <div class="uk-navbar-right">
            @if(isset($siteLocales))
            <div class="uk-navbar-item">
                <form id="change-l" action="{{ route('change-locale') }}" method="POST">
                    @csrf
                    {!! $siteLocales !!}
                </form>
            </div>
            @endif
            <ul class="uk-navbar-nav">
                @auth
                    <li><a href="{{ url('/home') }}">Home</a></li>
                @else
                    <li><a href="{{ url('/login') }}">{{ __('Login') }}</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ url('/register') }}">{{ __('Register') }}</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </nav>
</div>
<div class="uk-section-xsmall uk-section-default" uk-height-viewport="expand: true">
    <div class="uk-container">
        <form id="token-post" action="{{route('token-post')}}" method="post">
            @csrf
            First name:<br>
            <input type="text" name="form-data" value="Some data">
            <br><br>
            <input type="submit" value="Submit">
            <input id="axios-post" type="button" value="Axios Post">
        </form>
    </div>
</div>
<div class="uk-section-xsmall uk-section-secondary">
    <div class="uk-container uk-text-center">
        <div>Lorem ipsum dolor sit amet.</div>
    </div>
</div>
<script src="{{ asset('js/all.js') }}" defer></script>
<script src="{{ asset('js/token.js') }}" defer></script>

</body>
</html>
