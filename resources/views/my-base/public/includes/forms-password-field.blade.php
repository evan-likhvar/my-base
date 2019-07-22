<label class="uk-form-label" for="form-horizontal-text">{{ __('Password') }}</label>
<div class="uk-form-controls">
    <input class="uk-input @error('password') uk-form-danger @enderror" id="password" type="password" name="password"
           placeholder="{{ __('Password') }}" required autocomplete="current-password">
</div>
@error('password')<div class="uk-text-danger uk-text-center"><strong>{{ $message }}</strong></div>@enderror
