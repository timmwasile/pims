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





<!-- employee_id Field -->


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.jobtitles.index') }}" class="btn btn-light">Cancel</a>
</div>
