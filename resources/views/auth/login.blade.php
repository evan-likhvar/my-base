@extends(config('site-settings.theme-views-public').'.layout')

@section('content')
    <div class="uk-inline uk-width-1-1" uk-height-viewport="expand: true">
        <div class="uk-position-center uk-overlay uk-overlay-default">
            <form class="uk-form-horizontal uk-margin-large" method="POST" action="{{ route('login') }}">
                @csrf
                <legend class="uk-legend uk-text-center"><h2>{{ __('Login') }}</h2></legend>

                <div class="uk-margin">
                    @include(config('site-settings.theme-views-public').'.includes.forms-email-field')
                </div>

                <div class="uk-margin">
                    @include(config('site-settings.theme-views-public').'.includes.forms-password-field')
                </div>

                <div class="uk-margin">
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}</label>
                    </div>
                </div>
                <div class="uk-margin uk-text-center">
                    <button type="submit" class="uk-button uk-button-primary">{{ __('Login') }}</button>
                </div>
                @if (Route::has('password.request'))
                    <div class="uk-margin uk-text-center">
                        <a href="{{route('password.request')}}">{{ __('Forgot Your Password?') }}</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
