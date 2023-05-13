@extends('layouts.guest')

@section('title', __('Reset password'))

@section('content')
<form method="POST" action="{{ route('password.confirm') }}">
  @csrf
  <div class="alert alert-success mt-n4 ml-n4 mr-n4 mb-3 rounded-0" role="alert">
    {{ __('Set new password.') }}
  </div>
  <div class="form-group">
    <label for="email">{{ __('E-Mail Address') }}</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
      value="{{ old('email') }}" required autocomplete="email" autofocus>
    @error('email')
    <p class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </p>
    @enderror
  </div>
  <div class="form-group">
    <label for="password">{{ __('Password') }}</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
      required autocomplete="new-password">
    @error('password')
    <p class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </p>
    @enderror
  </div>
  <div class="form-group">
    <label for="password-confirm">{{ __('Confirm Password') }}</label>
    <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required
      autocomplete="new-password">
  </div>

  <button type="submit" class="btn btn-block btn-primary">{{ __('Reset Password') }}</button>

  <div class="row mt-3">
    <div class="col-auto">
      <a href="{{ route('login') }}">{{ __('Back to Login') }}</a>
    </div>
  </div>

</form>
@endsection
