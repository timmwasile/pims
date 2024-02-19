<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'offices Name:') !!}
   <div class = 'form-control'> {{ ucwords($Office->name) }}</div>
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Office Description:') !!}
   <div class = 'form-control'> {{ $Office->description }}</div>
</div>

</div>