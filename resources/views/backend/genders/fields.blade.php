<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'gender Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>

<!-- loadnDescription Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'gender Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.genders.index') }}" class="btn btn-light">Cancel</a>
</div>
