<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Financial Year Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120], 'name'=>'name') !!}
</div>



<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'started_at:') !!}
    {!! Form::text('started_at', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120. 'id' => 'started_at']) !!}
    @error('employment_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'ended_at:') !!}
    {!! Form::text('ended_at', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120,  'id' => 'ended_at']) !!}
    @error('employment_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.fyears.index') }}" class="btn btn-light">Cancel</a>
</div>
