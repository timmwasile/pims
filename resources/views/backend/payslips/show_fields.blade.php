<div class="row">

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'salaries started_at:') !!}
   <div class = 'form-control'> {{ date('d F, Y (l)',strtotime($salary->started_at)) }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
   <div class = 'form-control'> {{ date('d F, Y (l)',strtotime($salary->ended_at)) }}</div>
</div>

<!-- payment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment', 'Total Payments:') !!}
   <div class = 'form-control'> {{ "TZS ".number_format($payment,2) }}</div>
</div>

<!-- deduction Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deduction', 'Total Deductions:') !!}
   <div class = 'form-control'> {{ "TZS ".number_format($deduction,2) }}</div>
</div>

<!-- loan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loan', 'Total Amount for Loan:') !!}
   <div class = 'form-control'> {{ "TZS ".number_format($loan,2) }}</div>
</div>



</div>