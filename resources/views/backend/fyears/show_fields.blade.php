<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Financial year name:') !!}
   <div class = 'form-control'> {{ date('d F, Y (l)',strtotime($Fyear->name)) }}</div>
</div>

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'salaries started_at:') !!}
   <div class = 'form-control'> {{ date('d F, Y (l)',strtotime($Fyear->started_at)) }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
   <div class = 'form-control'> {{ date('d F, Y (l)',strtotime($Fyear->ended_at)) }}</div>
</div>

</div>