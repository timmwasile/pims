{!! Form::open(['route' => ['admin.plots.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
     @if ($balance !=0)
    <a href="{{ route('admin.plots.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @can('plot_edit')
        
     <a href="{{ route('admin.plots.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan

   <a href="{{ route('admin.plots.transaction', $id, $balance ) }}" class='btn btn-warning btn-xs'>
        <i class="fab fa-paypal" >  </i>
        	
    </a>
     <a href="{{ route('admin.plots.print', $id, $balance) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-print" >  </i>
    </a> 
    @can('plot_delete')
        
 {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')",
    ]) !!}
    @endcan
        
    @else
    <a href="{{ route('admin.plots.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.plots.print', $id, $balance) }}" class='btn btn-primary btn-xs'>
        <i class="fa fa-print" >  </i>
    </a> 
         
    @endif
   
   
</div>
{!! Form::close() !!}
