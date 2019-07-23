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

<div class="uk-section">
    <div class="uk-container">
        <div uk-grid>
            <div class="uk-width-auto@m">
                <input id="axios-post1" type="button" value="Push something to 'Public chanel'"><br>
                <input id="axios-post2" type="button" value="Push something to 'Private chanel'"><br>
                <input id="axios-post3" type="button" value="Push something to 'Presence chanel"><br>
                <input id="axios-post4" type="button" value="Push notification"><br>
            </div>
            <div class="uk-width-expand@m">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
                    <h3 class="uk-card-title">Public chanel</h3>
                    <div id="public_chanel_data"></div>
                </div>
                <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
                    <h3 class="uk-card-title">Private chanel</h3>
                    <div id="private_chanel_data"></div>
                </div>
                <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
                    <h3 class="uk-card-title">Presence chanel</h3>
                    <div>
                        <ul id="presence_chanel_data" class="uk-list uk-list-striped">

                        </ul>
                    </div>
                    <div class="uk-card-footer">
                        On line<br>
                        <div id="chat_users">
                            <a href="#" class="uk-button uk-button-text">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-section-xsmall uk-section-default" uk-height-viewport="expand: true">
    <div class="uk-container">

    </div>
</div>
<div class="uk-section-xsmall uk-section-secondary">
    <div class="uk-container uk-text-center">
        <div>Lorem ipsum dolor sit amet.</div>
    </div>
</div>
<script src="{{ asset('js/all.js') }}" defer></script>
<script src="{{ asset('js/broadcast.js') }}" defer></script>

</body>
</html>
