<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Project Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Project Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>
<!-- location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'Project location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>
<!-- amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount Per SQM:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120]) !!}
 @error('amount')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- initial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial', 'Project Initial:') !!}
    {!! Form::text('initial', null, ['class' => 'form-control', 'maxlength' => 3, 'maxlength' => 3, 'placeholder'=>'Only Three characters']) !!}
</div>
<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Total Project Size in SQM:') !!}
    {!! Form::text('size', null, ['class' => 'form-control number-separator', 'maxlength' => 60, 'maxlength' => 60, 'placeholder'=>'Total Project Size in SQM']) !!}
</div>
<!-- number_of_plots Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_of_plots', 'Total Number of Plot(s):') !!}
    {!! Form::text('number_of_plots', null, ['class' => 'form-control number-separator', 'maxlength' => 60, 'maxlength' => 60, 'placeholder'=>'Total Number of Plot(s)']) !!}
</div>
<!-- code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Project Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 6, 'maxlength' => 6]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.projects.index') }}" class="btn btn-light">Cancel</a>
</div>
