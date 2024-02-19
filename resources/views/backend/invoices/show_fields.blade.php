<div class="row">

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Loan Description:') !!}
   <div class = 'form-control'> {{ $Loan->description }}</div>
</div>

<!-- loan_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loan_amount', 'loan_amount:') !!}
   <div class = 'form-control'> {{ $Loan->loan_amount }}</div>
</div>

<!-- loan_balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loan_balance', 'loan_balance:') !!}
   <div class = 'form-control'> {{ $Loan->loan_balance }}</div>
</div>

<!-- rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'Rate:') !!}
   <div class = 'form-control'> {{ $Loan->rate }}</div>
</div>

<!-- duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'duration:') !!}
  <div class = 'form-control'>  {{ $Loan->duration }}</div>
</div>

<!-- employee_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'employee_id:') !!}
  <div class = 'form-control'>  {{ $Loan->employee_id }}</div>
</div>

<!-- status_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'status_id:') !!}
  <div class = 'form-control'>  {{ $Loan->status_id }}</div>
</div>

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'started_at:') !!}
 <div class = 'form-control'>   {{ $Loan->started_at }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
 <div class = 'form-control'>   {{ $Loan->ended_at }}</div>
</div>

</div>