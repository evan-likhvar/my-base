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
<nav class="uk-navbar uk-navbar-container" uk-navbar>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            @auth
                <li><a id="logout-button" href="{{ route('logout') }}">{{ __('Logout') }}</a></li>
            @else
                <li><a href="{{ url('/login') }}">{{ __('Login') }}</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ url('/register') }}">{{ __('Register') }}</a></li>
                @endif
            @endauth
        </ul>
    </div>
</nav>
<form id="auth-logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>

<div class="uk-section-xsmall uk-section-default" uk-height-viewport="expand: true">
    <div class="uk-container-expand">
        @yield('content')
    </div>
</div>
<div class="uk-section-xsmall uk-section-secondary">
    <div class="uk-container uk-text-center">
        <div>Lorem ipsum dolor sit amet.</div>
    </div>
</div>
<script src="{{ asset('js/all.js') }}" defer></script>
</body>
</html>
