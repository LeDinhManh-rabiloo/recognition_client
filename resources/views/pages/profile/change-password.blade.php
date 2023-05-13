@extends('layouts.app')

@section('title', __('Change password'))

@section('content')
@component('components.page-header')
<a href="{{ route('profile.edit')}} " class="btn btn-sm btn-outline-secondary ml-2">{{ __('Update profile') }}</a>
@endcomponent

<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('password.change') }}">
      @csrf

      <div class="form-group">
        <label for="password-current">{{ __('Current Password') }}</label>
        <input type="password" name="current_password" id="password-current"
          class="form-control @error('current_password') is-invalid @enderror" required autofocus autocomplete="current-password">
        @error('current_password')
        <p class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input type="password" name="password" id="password"
          class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
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

      <div class="form-group border-top pt-3 mb-0">
        <button type="submit" class="btn btn-primary mr-2">
          {{ __('Save') }}
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
