<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'name:') !!}
   <div class = 'form-control'> {{ $marketing_officer->name }}</div>
</div>

<!-- address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'address:') !!}
   <div class = 'form-control'> {{ $marketing_officer->address }}</div>
</div>

<!-- mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', ' mobiles:') !!}
   <div class = 'form-control'> {{ $marketing_officer->mobile }}</div>
</div>

<!-- nida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nida', ' nida:') !!}
   <div class = 'form-control'> {{ $marketing_officer->nida}}</div>
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'description:') !!}
   <div class = 'form-control'> {{ $marketing_officer->description }}</div>
</div>



</div>