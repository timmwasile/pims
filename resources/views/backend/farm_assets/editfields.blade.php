<!-- number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'Plot number:') !!}
    {!! Form::text('number', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60, 'readonly']) !!}
</div><!-- customer_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Name:') !!}
    {{ Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'name' => 'customer_id']) }}
        @error('customer_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- project_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Name:') !!}
    {{ Form::select('project_id', $farm, null, ['class' => 'form-control select2', 'name' => 'project_id']) }}
        @error('project_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- payment_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Customer Name:') !!}
    {{ Form::select('payment_id', $payments, null, ['class' => 'form-control select2', 'name' => 'payment_id']) }}
        @error('payment_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


    <!-- marketing_officer_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('marketing_officer_id', 'Customer Name:') !!}
    {{ Form::select('marketing_officer_id', $marketing_officers, null, ['class' => 'form-control select2', 'name' => 'marketing_officer_id']) }}
        @error('marketing_officer_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Start_date:') !!}
    {!! Form::text('started_at', null, ['class' => 'form-control', 'id' => 'started_at', 'autocomplete'=>'off']) !!}
     @error('started_at')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration in Months :') !!}
    {!! Form::number('duration', null, ['class' => 'form-control number-separator', 'min'=> 1, 'maxlength' => 120, 'maxlength' => 120]) !!}

 @error('duration')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Plot Size in sqm :') !!}
    {!! Form::text('size', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120]) !!}
 @error('size')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- total_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount to be Paid:') !!}
    {!! Form::text('total_amount', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120]) !!}
 @error('total_amount')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- paid_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paid_amount', 'Paid Amount:') !!}
    {!! Form::text('paid_amount', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120]) !!}
 @error('paid_amount')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textArea('description', null, ['class' => 'form-control', 'maxlength' => 120, 'rows' => 10,  ]) !!}
 @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- penalty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penalty', 'Plot penalty:') !!}
    {!! Form::text('penalty', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.farm_assets.index') }}" class="btn btn-light">Cancel</a>
</div>
