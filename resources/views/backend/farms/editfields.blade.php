<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'size:') !!}
    {!! Form::text('size', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- number_of_plots Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_of_plots', 'number_of_plots:') !!}
    {!! Form::text('number_of_plots', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- initial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial', 'initial:') !!}
    {!! Form::text('initial', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.farms.index') }}" class="btn btn-light">Cancel</a>
</div>
