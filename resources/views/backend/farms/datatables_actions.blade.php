{!! Form::open(['route' => ['admin.farms.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('admin.farms.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
     <a href="{{ route('admin.farms.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {{-- <a href="{{ route('admin.farms.print', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-print">Print</i>
    </a> --}}

     {{-- <a href="{{ route('admin.farms.export', ['id' => $id, 'started_at' =>  $started_at] ) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-file">BankExport</i>
    </a> --}}
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')",
    ]) !!}
</div>
{!! Form::close() !!}
