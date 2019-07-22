<label class="uk-form-label" for="form-horizontal-text">{{ __('E-Mail Address') }}</label>
<div class="uk-form-controls">
    <input class="uk-input @error('email') uk-form-danger @enderror" id="email" type="email" name="email"
           placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
</div>
@error('email')<div class="uk-text-danger uk-text-center"><strong>{{ $message }}</strong></div>@enderror
