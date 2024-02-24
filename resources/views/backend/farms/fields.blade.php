<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'farm Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'farm Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<!-- location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'farm location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
    @error('location')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<!-- amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount Per Acre:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120]) !!}
 @error('amount')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- initial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial', 'farm Initial:') !!}
    {!! Form::text('initial', null, ['class' => 'form-control', 'maxlength' => 3, 'maxlength' => 3, 'placeholder'=>'Only Three characters']) !!}
    @error('initial')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Total farm Size in Acre:') !!}
    {!! Form::text('size', null, ['class' => 'form-control number-separator', 'maxlength' => 60, 'maxlength' => 60, 'placeholder'=>'Total farm Size in Acres']) !!}
    @error('size')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>




<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.farms.index') }}" class="btn btn-light">Cancel</a>
</div>
