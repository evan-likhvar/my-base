<label class="uk-form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
<div class="uk-form-controls">
    <input class="uk-input" id="password-confirm" type="password" name="password_confirmation"
           value="{{ old('password_confirmation') }}" placeholder="{{ __('Confirm Password') }}" required
           autocomplete="new-password">
</div>