<div class="row">

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Payroll Description:') !!}
   <div class = 'form-control'> {{ $Payroll->description }}</div>
</div>

<!-- basic_pay Field -->
<div class="form-group col-sm-6">
    {!! Form::label('basic_pay', 'basic_pay:') !!}
   <div class = 'form-control'> {{ $Payroll->basic_pay }}</div>
</div>

<!-- nssf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nssf', 'nssf:') !!}
   <div class = 'form-control'> {{ $Payroll->nssf }}</div>
</div>

<!-- paye Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paye', 'paye:') !!}
   <div class = 'form-control'> {{ $Payroll->paye }}</div>
</div>

<!-- net_pay Field -->
<div class="form-group col-sm-6">
    {!! Form::label('net_pay', 'net_pay:') !!}
   <div class = 'form-control'> {{ $Payroll->net_pay }}</div>
</div>

<!-- nhif Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nhif', 'nhif:') !!}
   <div class = 'form-control'> {{ $Payroll->nhif }}</div>
</div>

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'started_at:') !!}
   <div class = 'form-control'> {{ $Payroll->started_at }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
   <div class = 'form-control'> {{ $Payroll->ended_at }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
   <div class = 'form-control'> {{ $Payroll->ended_at }}</div>
</div>

<!-- employee_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'employee_id:') !!}
   <div class = 'form-control'> {{ $Payroll->employee_id }}</div>
</div>

<!-- status_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'status_id:') !!}
   <div class = 'form-control'> {{ $Payroll->status_id }}</div>
</div>
</div>