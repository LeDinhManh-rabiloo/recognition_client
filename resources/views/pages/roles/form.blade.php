{!! Form::open(['url' => [$route], 'method' => $method]) !!}
<div class="form-group">
  {!! Form::label('name', __('Name')) !!}
  {!! Form::text('name', $role->name, ['class' => "form-control"]) !!}
  {!! Form::errors('name') !!}
</div>
<div class="form-group">
  {!! Form::label('permissions', __('Permissions')) !!}
  <div class="ml-2 ml-md-4">
    @foreach($allPermissions as $permission)
    <div class="custom-control custom-checkbox custom-control-inline">
      {!! Form::checkbox('permissions[]', $permission->name, in_array($permission->name, $inPermissions), [
        'id' => 'perm-' . $permission->id,
        'class' => 'custom-control-input',
      ]) !!}
      <label class="custom-control-label" for="perm-{{ $permission->id }}">
        {{ ucfirst($permission->name) }}
      </label>
    </div>
    @endforeach
  </div>
</div>
<div class="form-group border-top pt-3 mb-0">
  <button type="submit" class="btn btn-primary mr-2">
    <i class="far fa-save"></i> {{ __('Save') }}
  </button>
  <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
    <i class="fas fa-times"></i>
    {{__('Cancel') }}
  </a>
</div>
{!! Form::close() !!}
