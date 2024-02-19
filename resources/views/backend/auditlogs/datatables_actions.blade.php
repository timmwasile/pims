{!! Form::open(['route' => ['admin.auditlogs.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('admin.auditlogs.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>

</div>
{!! Form::close() !!}
