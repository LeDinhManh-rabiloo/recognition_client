@extends('layouts.app')

@section('title', __('My Profile'))

@section('content')
@component('components.page-header')
<a href="{{ route('profile.edit')}} " class="btn btn-sm btn-outline-secondary">{{ __('Update') }}</a>
<a href="{{ route('password.change')}} " class="btn btn-sm btn-outline-secondary ml-2">{{ __('Change password') }}</a>
@endcomponent

<div class="card">
  <div class="card-body">
    <div class="media">
      <img src="https://placeholder.pics/svg/300/DEDEDE/555555/no%20avatar" class="mr-3" alt="{{ $user->name }}">
      <div class="media-body">
        <h5 class="ml-2 mt-0 font-weight-bold">{{ $user->name }}</h5>
        <table class="table">
          <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <th>Created</th>
            <td>{{ $user->created_at }}</td>
          </tr>
          <tr>
            <th>Updated</th>
            <td>{{ $user->updated_at }}</td>
          </tr>
          <tr>
            <th>Verified</th>
            <td>{{ $user->email_verified_at }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
