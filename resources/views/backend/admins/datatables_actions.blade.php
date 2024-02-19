{!! Form::open(['route' => ['admin.admins.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('admin.admins.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.admins.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
@can('admin_delete')
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')",
    ]) !!}
@endcan
    
</div>
{!! Form::close() !!}

<form action="{{ route('admin.admins.passwordReset', $id) }}" method="POST"
    onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
    @csrf
    <input type="submit" class="btn btn-xs btn-dark my-1" value="{{ trans('global.reset_password') }}">
</form>
