<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Customer Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'autofocus' => 'true']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>
<!-- address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Physical Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>
<!-- mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile Number:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control', 'maxlength' => 6, 'maxlength' => 60]) !!}
</div>
<!-- nida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nida', 'NIDA Number:') !!}
    {!! Form::text('nida', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.customers.index') }}" class="btn btn-light">Cancel</a>
</div>
