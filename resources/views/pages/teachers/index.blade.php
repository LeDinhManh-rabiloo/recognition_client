@extends('layouts.app')

@section('title', __('Quản lý giảng viên'))

@section('content')
  @component('components.page-header')
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
