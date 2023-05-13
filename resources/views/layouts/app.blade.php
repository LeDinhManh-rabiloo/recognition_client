@extends('layouts.base')

@section('body-class', 'bg-grey overflow-auto scrollbar scrollbar-juicy-peach ')

@section('body')
<nav class="navbar navbar-expand navbar-dark bg-primary">
  <a class="navbar-brand mr-3" id="sidebar-toggle" href="#">
    <i class="fas fa-fw fa-bars"></i>
  </a>
  <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>

  <div class="navbar-collapse collapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="{{ url('/docs') }}" class="nav-link" target="_blank">
          <i class="far fa-question-circle"></i> <span class="d-none d-md-inline">Docs</span>
        </a>
      </li>
      <li class="nav-item position-relative">
        <a href="#notifications-list" class="nav-link" data-toggle="collapse">
          <i class="fas fa-fw fa-bell"></i>
        </a>
        <div class="card position-absolute collapse notification" id="notifications-list">
          <div class="card-header d-flex">
            <p class="mr-auto mb-0">{{ __('Notifications (:count)', ['count' => 305]) }}</p>
            <a href="btn btn-link">{{ __('Mark all as read') }}</a>
          </div>
          <ul class="list-group list-group-flush overflow-auto">
            @for($i = 1; $i <10; $i++) <li class="list-group-item">
              <div class="media">
                <img src="//placehold.it/45x45" class="mr-3" alt="...">
                <div class="media-body">
                  <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                    sollicitudin</p>
                  <p class="mb-0 text-muted">
                    <small><i class="fas fa-fw fa-clock mr-1"></i> Donec lacinia congue felis</small>
                  </p>
                </div>
                <div class="">
                  <a href="#" class="d-inline-block rounded-circle"></a>
                </div>
              </div>
      </li>
      @endfor
    </ul>
    <div class="card-footer text-center">
      <a href=""><i class="fas fa-eye"></i> See all</a>
    </div>
  </div>
  </li>
  <li class="nav-item dropdown">
    <a href="#" id="userDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown">
      <i class="fas fa-user-circle"></i> <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
      <a href="{{ route('profile.show') }}" class="dropdown-item{{ request()->is('/profile') ? ' active' : '' }}">Update
        Profile</a>
      <a href="{{ route('password.change') }}"
        class="dropdown-item{{ request()->is('/password/change') ? ' active' : '' }}">Change Password</a>
      <div class="dropdown-divider"></div>
      <p class="dropdown-item logout_st">
        {{ __('Logout') }}
      </p>

      <form id="logout-form" class="log-out" action="{{ route('logout') }}" method="POST">
        @csrf
      </form>
    </div>
  </li>
  </ul>
  </div>
</nav>

<div class="wrapper d-flex @if (Request::is('dashboard*')) wrapper-toggled @endif">
  <div class="sidebar sidebar-dark bg-dark" id="sidebar">
    {!! Menu::mainMenu() !!}
  </div>

  <div class="content p-3 px-md-5 pt-md-3">
    @yield('content')
  </div>
</div>
@endsection

@push('styles')
<style>
  .notification {
    width: 26rem;
    height: 30rem;
    top: 42px;
    right: -1rem;
    z-index: 999
  }

  .log-out {
    display: none;
  }

  .logout_st {
    margin-bottom: 0;
    cursor: pointer
  }
</style>
@endpush
@push('scripts')
<script>
  $(document).on("click", ".logout_st", function (event) {
      event.preventDefault();
      $('#logout-form').submit();
    })
</script>
@endpush
