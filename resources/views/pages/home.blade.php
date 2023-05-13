@extends('layouts.app')

@section('title', 'Home')

@section('content')
@component('components.page-header')
<div class="btn-group mr-2">
  <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
  <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
</div>
<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
  <span data-feather="calendar"></span>
  This week
</button>
@endcomponent

<div class="card">
  <div class="card-body">
    You are logged in!
  </div>
</div>
@endsection
