{!! Form::open(['route' => ['admin.payslips.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
        <a href="{{ route('admin.payslips.payslip', ['id' => $id, 'salary_id' => $salary_id, 'started_at'=>$started_at]) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-print">Payslip</i>
    </a>
</div>
{!! Form::close() !!}
