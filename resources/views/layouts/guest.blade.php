@extends('layouts.base')

@section('body-class', 'bg-grey h-100')

@section('body')
<div class="container h-100" id="app">
  <div class="row justify-content-center align-items-center h-100">
    <div class="col-10 px-0 auth-form">
      <h2 class="text-center mb-4">
        <a href="{{ route('home') }}" class="text-dark text-decoration-none">
          <i class="fas fa-fw fa-cog"></i>
          <span class="mr-2">{{ config('app.name') }}</span>
        </a>
      </h2>

      <div class="card mb-5">
        <div class="card-body p-4">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
