@extends('layouts.guest')

@section('title', __('Confirm password'))

@section('content')
<form method="POST" action="{{ route('password.confirm') }}">
  @csrf
  <div class="alert alert-warning mt-n4 ml-n4 mr-n4 mb-3 rounded-0" role="alert">
    {{ __('Please confirm your password before continuing.') }}
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

  <button type="submit" class="btn btn-block btn-primary">{{ __('Confirm Password') }}</button>

  <div class="row mt-3">
    <div class="col-auto">
      <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
    </div>
  </div>
</form>
@endsection
