<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Financial Year Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>
<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Start from:') !!}
    {!! Form::text('started_at', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60,'id' => 'started_at']) !!}
</div>
<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'Ended at:') !!}
    {!! Form::text('ended_at', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60,'id' => 'ended_at']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.fyears.index') }}" class="btn btn-light">Cancel</a>
</div>
