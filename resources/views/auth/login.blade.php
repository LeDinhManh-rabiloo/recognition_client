@extends('layouts.guest')

@section('title', __('Login'))

@section('content')
<form method="POST" action="{{ route('login') }}">
  @csrf

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
      required autocomplete="current-password">
    @error('password')
      <p class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </p>
    @enderror
  </div>

  <div class="row mb-3">
    <div class="col">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" id="remember" class="custom-control-input"
          @if(old('remember')) checked @endif>
        <label for="remember" class="custom-control-label">{{ __('Remember Me') }}</label>
      </div>
    </div>
    <div class="col-auto">
      <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
    </div>
  </div>

  <button type="submit" class="btn btn-block btn-primary">{{ __('Login') }}</button>
</form>
@endsection
