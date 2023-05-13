<div class="d-inline-block">
  <a class="btn btn-sm btn-link text-secondary" href="{{route('roles.edit', $id)}}" title="{{ __('Edit') }}">
    <i class="fas fa-fw fa-lg fa-edit"></i>
  </a>
  <a class="btn btn-sm btn-link text-secondary" href="#"
    data-toggle="modal" data-target="#modal-delete-role-{{ $id }}" title="{{ __('Delete') }}">
    <i class="fas fa-fw fa-lg fa-trash"></i>
  </a>

  <div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-role-{{ $id }}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> {{ __('Delete role') }} </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          {!! __('Are you sure want to delete role <b>:name</b> ?', ['name' => $name]) !!}
        </div>
        <div class="modal-footer">
          <form action="{{route('roles.destroy', $id) }}" method="POST" id="delete-role-{{ $id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-width-default text-white">
              {{ __('Delete') }}
            </button>
            <button type="button" class="btn btn-secondary btn-width-default" data-dismiss="modal">
              {{ __('Cancel') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
