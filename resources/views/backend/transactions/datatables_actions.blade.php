{!! Form::open(['route' => ['admin.transactions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
  
   
  
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')",
    ]) !!}
</div>
{!! Form::close() !!}
