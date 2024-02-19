<!-- id Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('id', 'id:') !!}
    {!! Form::text('id', null, ['class' => 'form-control', 'id' => 'id']) !!}
</div>

<!-- name Field -->

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null,  ['class' => 'form-control', 'id' => 'name', 'disabled']) !!}
</div>
<!-- fyear Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fyear_id', 'Financial Year:') !!}
    {{ Form::select('fyear_id', $fyears, null, ['class' => 'form-control select2', 'name' => 'fyear_id','readonly']) }}
 @error('fyear_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- office  Field -->
<div class="form-group col-sm-6">
    {!! Form::label('office_id', 'Office Name:') !!}
    {{ Form::select('office_id', $offices, null, ['class' => 'form-control select2', 'name' => 'office_id', 'required']) }}
 @error('offices_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>



<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description','placeholder'=>'Brielf description']) !!}
</div>
<!-- amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Expensed Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60,'id' => 'amount','placeholder'=>'Enter the expensed amount']) !!}
</div>





<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.activities.index') }}" class="btn btn-light">Cancel</a>
</div>
