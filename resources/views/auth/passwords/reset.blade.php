@extends(config('site-settings.theme-views-public').'.layout')

@section('content')
    <div class="uk-inline uk-width-1-1" uk-height-viewport="expand: true">
        <div class="uk-position-center uk-overlay uk-overlay-default">
            <form class="uk-form-horizontal uk-margin-large" method="POST" action="{{ route('password.update') }}">
                @csrf
                <legend class="uk-legend uk-text-center"><h2>{{ __('Reset Password') }}</h2></legend>

                <div class="uk-margin">
                    @include(config('site-settings.theme-views-public').'.includes.forms-email-field')
                </div>

                <div class="uk-margin">
                    @include(config('site-settings.theme-views-public').'.includes.forms-password-field')
                </div>

                <div class="uk-margin">
                    @include(config('site-settings.theme-views-public').'.includes.forms-confirm-password-field')
                </div>

                <div class="uk-margin uk-text-center">
                    <button type="submit" class="uk-button uk-button-primary">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


@endsection
