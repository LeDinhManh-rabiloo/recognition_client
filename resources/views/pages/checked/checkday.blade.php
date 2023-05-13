@extends('layouts.app')

@section('title', __($class->name))

@section('content')
  @component('components.page-header')
  @endcomponent

  <div class="card">
    <div class="card-body">
      {!! $dataTable->table() !!}
      <div class="row">
        {!! Form::open(['url' => route('studentcheck.store'), 'method' => 'POST', 'id' => 'storeCheck']) !!}
        {!! Form::hidden('classId', $class->courseId, ['class' => "form-control", 'id' => 'classId']) !!}
        <button class="btn btn-success" id="verify">Điểm danh</button>
        {!! Form::close() !!}
      </div>
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
