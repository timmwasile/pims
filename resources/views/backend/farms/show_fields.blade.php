<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name of the farm:') !!}
   <div class = 'form-control'> {{ ucwords($farm->name )}}</div>
</div>

<!-- location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'farm Location:') !!}
   <div class = 'form-control'> {{ ucwords($farm->location )}}</div>
</div>

<!-- amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount Per Acre:') !!}
   <div class = 'form-control' > {{ number_format($farm->amount,2) }}/=</div>

</div>

<!-- initial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial', ' farm Initial:') !!}
   <div class = 'form-control'> {{ ucwords($farm->initial)}}</div>
</div>

<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'farm Size (Acres):') !!}
   <div class = 'form-control'> {{ number_format($farm->size).' Acres' }}</div>
</div>



</div>
