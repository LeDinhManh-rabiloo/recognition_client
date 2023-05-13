{!! Form::open(['url' => [$route], 'method' => $method]) !!}
<div class="form-group">
  {!! Form::label('name', __('Họ và tên')) !!}
  {!! Form::text('name', $user->name, ['class' => "form-control"]) !!}
  {!! Form::errors('name', ['style' => 'display:block !important']) !!}
</div>
<div class="form-group">
  {!! Form::label('email', __('Email')) !!}
  {!! Form::email('email', $user->email, ['class' => "form-control"]) !!}
  {!! Form::errors('email', ['style' => 'display:block !important']) !!}
</div>

<div class="form-group">
  {!! Form::label('magv', __('Mã Giảng viên (nếu tài khoản là giảng viên)')) !!}
  @if ($user->teacher != null)
    {!! Form::text('magv', $user->teacher->magv, ['class' => "form-control"]) !!}
  @else
    {!! Form::text('magv', null, ['class' => "form-control"]) !!}
  @endif
  {!! Form::errors('magv') !!}
</div>
<div class="form-group">
  {!! Form::label('roles', __('Roles')) !!}
  <div class="ml-2 ml-md-4">
    @foreach($roles as $role)
      <div class="custom-control custom-checkbox custom-control-inline">
        {!! Form::radio('role', $role->name, in_array($role->name, $inRoles), [
          'id' => 'roles-' . $role->id,
          'class' => 'custom-control-input',
        ]) !!}
        <label class="custom-control-label" for="roles-{{ $role->id }}">
          {{ ucfirst($role->name) }}
        </label>
      </div>
    @endforeach
  </div>
  {!! Form::errors('role') !!}
</div>
<div class="form-group border-top pt-3 mb-0">
  <button type="submit" class="btn btn-primary mr-2">
    <i class="far fa-save"></i> {{ __('Save') }}
  </button>
  <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
    <i class="fas fa-times"></i>
    {{__('Cancel') }}
  </a>
</div>
{!! Form::close() !!}
