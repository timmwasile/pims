<!-- startdate Field -->
<div class="form-group col-sm-2">
    {!! Form::label('started_at', 'Payment Date:') !!}
    {!! Form::text('started_at', null, ['class' => 'form-control', 'id' => 'started_at', 'autocomplete'=>'off']) !!}
     @error('started_at')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>


<!-- ended_at Field -->
<div class="form-group col-sm-2">
    {!! Form::label('ended_at', 'Payment Date:') !!}
    {!! Form::text('ended_at', null, ['class' => 'form-control', 'id' => 'ended_at', 'autocomplete'=>'off']) !!}
     @error('ended_at')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- customer_id Field -->
    <div class="form-group col-sm-3">
    {!! Form::label('customer_id', 'Customer Name:') !!}
    {{ Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'name' => 'customer_id']) }}
        @error('customer_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
<!-- Submit Field -->
<div class="form-group col-sm-2">
    {!! Form::label('', '') !!}
    {!! Form::submit('Download', ['class' => 'form-control btn btn-info']) !!}
    <a href="{{ route('admin.transactions.index') }}" class="form-control btn btn-light">Cancel</a>
</div>
