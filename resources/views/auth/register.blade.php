@extends(config('site-settings.theme-views-public').'.layout')

@section('content')
    <div class="uk-inline uk-width-1-1" uk-height-viewport="expand: true">
        <div class="uk-position-center uk-overlay uk-overlay-default">
            <form class="uk-form-horizontal uk-margin-large" method="POST" action="{{ route('register') }}">
                @csrf
                <legend class="uk-legend uk-text-center"><h2>{{ __('Register') }}</h2></legend>

                <div class="uk-margin">
                    <label class="uk-form-label" for="name">{{ __('Name') }}</label>
                    <div class="uk-form-controls">
                        <input class="uk-input @error('name') uk-form-danger @enderror" id="name" type="text" name="name"
                               value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autocomplete="name"
                               autofocus>
                    </div>
                    @error('name')<div class="uk-text-danger uk-text-center"><strong>{{ $message }}</strong></div>@enderror
                </div>

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
                    <button type="submit" class="uk-button uk-button-primary">{{ __('Register') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
