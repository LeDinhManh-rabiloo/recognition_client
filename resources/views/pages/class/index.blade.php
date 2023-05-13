@extends('layouts.app')

@section('title', __('Quản lý lớp học'))

@section('content')
  @component('components.page-header')
    <a href="{{ route('classcourse.create') }}" class="btn btn-sm btn-primary">{{ __('Tạo lớp học')}}</a>
    <a href="{{ route('classcourse.crmany') }}" class="ml-3 btn btn-sm btn-danger">{{ __('Tạo nhiều lớp học')}}</a>
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
