<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name of the Project:') !!}
   <div class = 'form-control'> {{ ucwords($project->name )}}</div>
</div>

<!-- location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'Project Location:') !!}
   <div class = 'form-control'> {{ ucwords($project->location )}}</div>
</div>

<!-- code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', ' Project Codes:') !!}
   <div class = 'form-control'> {{ ucwords($project->code) }}</div>
</div>

<!-- initial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial', ' Project Initial:') !!}
   <div class = 'form-control'> {{ ucwords($project->initial)}}</div>
</div>

<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Project Size (sqm):') !!}
   <div class = 'form-control'> {{ number_format($project->size).' Square Meter' }}</div>
</div>



</div>