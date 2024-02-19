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

<!-- address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- nida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nida', 'nida:') !!}
    {!! Form::text('nida', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.marketing_officers.index') }}" class="btn btn-light">Cancel</a>
</div>
