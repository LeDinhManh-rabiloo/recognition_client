@extends('layouts.app')

@section('title', __('Setting System Economy'))

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>@yield('title')</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Back to home')}}</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="group-tabs">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
{{--            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#yahoo" role="tab" aria-controls="yahoo" aria-selected="true">Yahoo</a>--}}
            <a class="nav-item nav-link active" id="nav-premax-tab" data-toggle="tab" href="#prema-x" role="tab" aria-controls="prema-x" aria-selected="false">Prema-X</a>
          </div>
        </nav>
        <div class="tab-content">
{{--          <div role="tabpanel" class="tab-pane active" id="yahoo">--}}
{{--            @if(!count($appinfors))--}}
{{--              {!! Form::open(['route' => 'settings.store', 'method' => 'POST']) !!}--}}
{{--              <div class="form-group">--}}
{{--                {!! Form::label('App_id', __('App_id')) !!}--}}
{{--                {!! Form::text('app_id', null, ['class' => "form-control"]) !!}--}}
{{--                {!! Form::errors('app_id') !!}--}}
{{--              </div>--}}
{{--              <div class="form-group">--}}
{{--                {!! Form::label('Secret', __('Secret')) !!}--}}
{{--                {!! Form::text('secret', null, ['class' => "form-control"]) !!}--}}
{{--                {!! Form::errors('secret') !!}--}}
{{--              </div>--}}
{{--              <div class="form-group border-top pt-3 mb-0">--}}
{{--                <button type="submit" class="btn btn-primary mr-2">--}}
{{--                  <i class="far fa-save"></i> {{ __('Save') }}--}}
{{--                </button>--}}
{{--                <a href="{{ route('home') }}" class="btn btn-outline-secondary">--}}
{{--                  <i class="fas fa-times"></i>--}}
{{--                  {{__('Cancel') }}--}}
{{--                </a>--}}
{{--              </div>--}}
{{--              {!! Form::close() !!}--}}
{{--            @endif--}}
{{--          </div>--}}
          <div role="tabpanel" class="tab-pane active" id="prema-x">
            @if (!count($premaxInfor))
              {!! Form::open(['route' => 'settingspremax.store', 'method' => 'POST']) !!}
              <div class="form-group">
                {!! Form::label('x_requested_with', __('X Requested With')) !!}
                {!! Form::text('x_requested_with', null, ['class' => "form-control"]) !!}
                {!! Form::errors('x_requested_with') !!}
              </div>
              <div class="form-group">
                {!! Form::label('Token', __('Token')) !!}
                {!! Form::text('token', null, ['class' => "form-control"]) !!}
                {!! Form::errors('token') !!}
              </div>
              <div class="form-group border-top pt-3 mb-0">
                <button type="submit" class="btn btn-primary mr-2">
                  <i class="far fa-save"></i> {{ __('Save') }}
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-times"></i>
                  {{__('Cancel') }}
                </a>
              </div>
              {!! Form::close() !!}
            @else
              <div class="mt-3">
                <button id="hard-update" class="btn btn-primary">Update</button>
                <button id="auto-aupdate" class="btn btn-danger">Auto Update</button>
              </div>
              {!! Form::open(['route' => ['settingspremax.update', $premaxInfor[0]->id], 'method' => 'PUT']) !!}
              <div class="form-group">
                {!! Form::label('x_requested_with', __('X Requested With')) !!}
                {!! Form::text('x_requested_with', $premaxInfor[0]->x_requested_with, ['class' => "form-control", 'disabled'=>'true', 'id' => 'X_request']) !!}
                {!! Form::errors('x_requested_with') !!}
              </div>
              <div class="form-group">
                {!! Form::label('Token', __('Token')) !!}
                {!! Form::text('token', $premaxInfor[0]->token, ['class' => "form-control", 'disabled'=>'true', 'id' => 'Token']) !!}
                {!! Form::errors('token') !!}
              </div>
              <div class="form-group border-top pt-3 mb-0">
                <button type="submit" class="btn btn-primary mr-2">
                  <i class="far fa-save"></i> {{ __('Save') }}
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-times"></i>
                  {{__('Cancel') }}
                </a>
              </div>
              {!! Form::close() !!}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')

@endpush

@push('scripts')
  <script>
    $(document).on('click', '#hard-update', function () {
      $('#X_request').removeAttr('disabled');
      $('#Token').removeAttr('disabled');
    });
  </script>
@endpush

