<div class="row">
<!-- employee_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'employee_name:') !!}
   <div class = 'form-control'> {{ ucwords($Monthly->employeeId->name) }}</div>
</div>

<!-- paymenmt_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Paymenmt_name:') !!}
   <div class = 'form-control'> {{ $Monthly->paymentId->name }}</div>
</div>

<!-- amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'amount:') !!}
   <div class = 'form-control'> {{ number_format($Monthly->amount,2) }}</div>
</div>


<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'started_at:') !!}
   <div class = 'form-control'> {{  date("d F, Y", strtotime($Monthly->ended_at))}}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
   <div class = 'form-control'> {{ date("d F, Y", strtotime($Monthly->ended_at)) }}</div>
</div>

<!-- created_by Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
   <div class = 'form-control'> {{ ucwords($Monthly->createdBy->name) }}</div>
</div>
</div>