<!-- loadnDescription Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Taxe Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>

<!-- max_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_amount', 'max_amount:') !!}
    {!! Form::text('max_amount', null, ['class' => 'form-control', 'id' => 'max_amount']) !!}
</div>

<!-- min_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_amount', 'min_amount:') !!}
    {!! Form::text('min_amount', null, ['class' => 'form-control', 'id' => 'min_amount']) !!}
</div>

<!-- rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'rate:') !!}
    {!! Form::text('rate', null, ['class' => 'form-control', 'id' => 'rate']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.taxes.index') }}" class="btn btn-light">Cancel</a>
</div>
