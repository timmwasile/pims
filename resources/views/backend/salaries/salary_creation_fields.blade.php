 <div class="form-group col-sm-6">
                <div class="checkbox">
                    <label class="required"  for="payment" >{{ trans('cruds.salary.fields.payment_basis') }}</label>
                    <input class="bg-light" id="payment" name="payment" type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-size="medium" data-onstyle="success" data-offstyle="light" checked>
                </div>                
            </div>

<div class="form-group col-sm-6">
                <div class="checkbox">
                    <label class="required"  for="deduction" >{{ trans('cruds.salary.fields.deduction') }}</label>
                    <input class="bg-light" id="deduction" name="deduction" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="NO" data-size="medium" data-onstyle="success" data-offstyle="light" checked>
                </div>                
            </div>

            <div class="form-group col-sm-6">
                <div class="checkbox">
                    <label class="required"  for="loan" >{{ trans('cruds.salary.fields.loan') }}</label>
                    <input class="bg-light" id="loan" name="loan" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="NO" data-size="medium" data-onstyle="success" data-offstyle="light" checked>
                </div>                
            </div>
            <div class="form-group col-sm-6">
                <div class="checkbox">
                    <label class="required"  for="begin_calculation" >{{ trans('cruds.salary.fields.begin_calculation') }}</label>
                    <input class="bg-light" id="begin_calculation" name="begin_calculation" type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-size="medium" data-onstyle="success" data-offstyle="light" checked>
                </div>                
            </div>


<!-- payment_date Field -->
<div class="form-group col-sm-4">
    {!! Form::label('payment_date', 'Payment Date:') !!}
    {!! Form::text('payment_date', null, ['class' => 'form-control', 'id' => 'started_at', 'autocomplete'=>'off']) !!}
     @error('payment_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Calculate', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.salaries.index') }}" class="btn btn-light">Cancel</a>
</div>
