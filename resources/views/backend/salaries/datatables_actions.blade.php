{!! Form::open(['route' => ['admin.salaries.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('admin.salaries.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.salaries.print', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-print">Statement</i>
    </a>

     <a href="{{ route('admin.salaries.export', ['id' => $id, 'started_at' =>  $started_at] ) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-file">BankExport</i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')",
    ]) !!}
</div>
{!! Form::close() !!}
