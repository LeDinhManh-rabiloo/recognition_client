@extends('layouts.guest')

@section('title', __('Reset password'))

@section('content')
<form method="POST" action="{{ route('password.email') }}">
  @csrf
  @if (session('status'))
  <div class="alert alert-success mt-n4 ml-n4 mr-n4 mb-3 rounded-0" role="alert">
    {{ session('status') }}
  </div>
  @else
  <div class="alert alert-success mt-n4 ml-n4 mr-n4 mb-3 rounded-0" role="alert">
    {{ __('Please input your e-mail address') }}
  </div>
  @endif
  <div class="form-group">
    <label for="email">{{ __('E-Mail Address') }}</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
      required autofocus autocomplete="email">
    @error('email')
    <p class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </p>
    @enderror
  </div>

  <button type="submit" class="btn btn-block btn-primary">{{ __('Send Password Reset Link') }}</button>

  <div class="row mt-3">
    <div class="col-auto">
      <a href="{{ route('login') }}">{{ __('Back to Login') }}</a>
    </div>
  </div>

</form>
@endsection
