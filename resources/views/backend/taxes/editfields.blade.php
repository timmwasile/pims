<!-- max_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_amount', 'max_amount:') !!}
    {!! Form::text('max_amount', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- min_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_amount', 'min_amount:') !!}
    {!! Form::text('min_amount', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'rate:') !!}
    {!! Form::text('rate', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>





<!-- employee_id Field -->


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.taxes.index') }}" class="btn btn-light">Cancel</a>
</div>
