<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Activity Name:') !!}
   <div class = 'form-control'> {{ $Activity->name }}</div>
</div>

<!-- budget Field -->
<div class="form-group col-sm-6">
    {!! Form::label('budget', 'Budget:') !!}
   <div class = 'form-control'> {{ number_format($Activity->budget,2) }}</div>
</div>

<!-- utilised Field -->
<div class="form-group col-sm-6">
    {!! Form::label('utilised', 'Utilised:') !!}
   <div class = 'form-control'> {{ number_format($Activity->utilised ,2)}}</div>
</div>

<!-- balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('balance', 'Balance:') !!}
   <div class = 'form-control'> {{ number_format($Activity->balance,2) }}</div>
</div>

<!-- fyear Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fyear', 'Financial year:') !!}
   <div class = 'form-control'> {{ $Activity->fyear->name }}</div>
</div>

</div>