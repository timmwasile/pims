<!-- id Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('id', 'id:') !!}
    {!! Form::text('id', null, ['class' => 'form-control', 'id' => 'id']) !!}
</div>


<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
     @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
     @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>


<!-- budget Field -->
<div class="form-group col-sm-6">
    {!! Form::label('budget', 'Amount:') !!}
    {!! Form::number('budget', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60,'id' => 'budget']) !!}
     @error('budget')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- fyear Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fyear_id', 'Financial Year:') !!}
    {{ Form::select('fyear_id', $fyears, null, ['class' => 'form-control select2', 'name' => 'fyear_id']) }}
 @error('fyear_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.activities.index') }}" class="btn btn-light">Cancel</a>
</div>
