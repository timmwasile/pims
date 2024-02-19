<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
   <div class = 'form-control'> {{ ucwords($Bank->name) }}</div>
</div>



<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'Descriptin:') !!}
   <div class = 'form-control'> {{ $Bank->description }}</div>
</div>

</div>