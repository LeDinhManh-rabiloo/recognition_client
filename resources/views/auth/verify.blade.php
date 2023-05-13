@extends('layouts.guest')

@section('title', __('Verify account'))

@section('content')
<div>
  @csrf
  @if (session('resent'))
  <div class="alert alert-success mt-n4 ml-n4 mr-n4 mb-3 rounded-0" role="alert">
    {{ __('A fresh verification link has been sent to your email address.') }}
  </div>
  @endif

  {{ __('Before proceeding, please check your email for a verification link.') }}
  {{ __('If you did not receive the email') }},
  <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
      {{ __('click here to request another') }}
    </button>.
  </form>
</div>
@endsection
