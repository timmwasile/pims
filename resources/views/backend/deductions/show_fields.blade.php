<div class="row">

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'deduction Description:') !!}
   <div class = 'form-control'> {{ ucwords($deduction->description) }}</div>
</div>

<!-- max_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_amount', 'max_amount:') !!}
   <div class = 'form-control'> {{ number_format($deduction->max_amount,2) }}</div>
</div>

<!-- min_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_amount', 'min_amount:') !!}
   <div class = 'form-control'> {{ number_format($deduction->min_amount,2) }}</div>
</div>

<!-- rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'rate:') !!}
   <div class = 'form-control'> {{ $deduction->rate }}</div>
</div>

</div>