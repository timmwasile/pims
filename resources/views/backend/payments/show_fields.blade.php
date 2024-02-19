<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'payment type:') !!}
   <div class = 'form-control'> {{ ucwords($payment->name) }}</div>
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'payment Description:') !!}
   <div class = 'form-control'> {{ ucwords($payment->description) }}</div>
</div>


<!-- discount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount', 'payment discount:') !!}
   <div class = 'form-control'> {{ $payment->discount."%" }}</div>
</div>



</div>