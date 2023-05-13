@extends('layouts.app')

@section('title', __('Check student'))
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>@yield('title')</h2>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Về trang chủ')}}</a>
  </div>
  <div class="row justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="col-sm-3">
      {!! Form::open(['url' => route('class.student'), 'method' => 'POST']) !!}
      <label for="Classes">Chọn lớp:</label>
      <div class="form-group">
        {!! Form::select('class_number', $classes, null, ['id' => 'class_number', 'class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Lọc', ['class' => 'btn btn-success']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      {!! $dataTable->table() !!}
    </div>
  </div>
@endsection

@push('styles')
  <style type="text/css">
    #results { padding:10px; border:1px solid; background:#ccc; }
  </style>
@endpush
@push('scripts')
  <script src="{{ mix('js/datatables.js') }}"></script>
  {!! $dataTable->scripts() !!}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.0/moment.min.js"></script>
@endpush
