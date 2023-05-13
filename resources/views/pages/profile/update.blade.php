@extends('layouts.app')

@section('title', __('Update Profile'))

@section('content')
@component('components.page-header')
<a href="{{ route('password.change')}} " class="btn btn-sm btn-outline-secondary ml-2">{{ __('Change password') }}</a>
@endcomponent

<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf

      <div class="form-group">
        <label for="name">{{ __('Fullname') }}</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
          value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
        @error('name')
        <p class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </p>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
          value="{{ old('email', $user->email) }}" required autocomplete="email">
        @error('email')
        <p class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </p>
        @enderror
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
