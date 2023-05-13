@extends('layouts.app')

@section('title', __('Quản lý người dùng'))

@section('content')
    @component('components.page-header')
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">{{ __('Tạo người dùng')}}</a>
    @endcomponent

    <div class="card">
      <div class="card-body">
        {!! $dataTable->table() !!}
      </div>
    </div>
@endsection

@push('scripts')
  <script src="{{ mix('js/datatables.js') }}"></script>
  {!! $dataTable->scripts() !!}
@endpush

@push('styles')
  <link rel="stylesheet" href="{{ mix('css/datatables.css') }}">
@endpush
