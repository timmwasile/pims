{{-- if check for payment or deduction --}}
<div class="form-group col-sm-2">
                <div class="checkbox">
                    
<label class="required" for="myCheck">{{ trans('cruds.monthly.fields.is_checkforpayment') }}</label> 
<input type="checkbox" id="myCheck" onclick="myFunction()"  class="bg-light"
                        name="transaction_type"
                         {{-- data-toggle="toggle" --}}
                        data-on="YES"
                        data-off="NO"
                        data-size="medium"
                        data-onstyle="success"
                        data-offstyle="light"
                        
                        >
                </div>
            </div>

<!-- Payment_For Field -->
     <div class="form-group col-sm-6" id="payment_id" >
        <label class="required" for="payment_id">{{ trans('cruds.monthly.fields.payment_name') }}</label>
        <select class="form-control select2 {{ $errors->has('payments') ? 'is-invalid' : '' }}" name="payments"
            id="payment_id" required>
            <option value="0">Please Select</option>
            @foreach ($payments as $payment)
             <option value="{{ $payment->id }}" >
                    {{ ucwords($payment->name) }}</option>
            @endforeach
        </select>
        @if ($errors->has('payment'))
            <div class="invalid-feedback">
                {{ $errors->first('payment') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.monthly.fields.payment_name_helper') }}</span>
    </div>

  <!-- Deduction_For Field -->
     <div class="form-group col-sm-6" id="deduction_id"  style="display:none" >
        <label class="required" for="deduction_id">{{ trans('cruds.monthly.fields.deduction_name') }}</label>
        <select class="form-control select2 {{ $errors->has('deductions') ? 'is-invalid' : '' }}" name="deductions"
            id="deduction_id" required>
            <option value="0">Please Select</option>
            @foreach ($deductions as $deduction)
                <option value="{{ $deduction->id }}" >
                    {{ ucwords($deduction->name .'  ~  (' .$deduction->description).')' }}</option>
            @endforeach
        </select>
        @if ($errors->has('deduction'))
            <div class="invalid-feedback">
                {{ $errors->first('deduction') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.monthly.fields.deduction_name_helper') }}</span>
    </div> 
{{-- script --}}
<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var payment_id = document.getElementById("payment_id");
  var deduction_id = document.getElementById("deduction_id");
  if (checkBox.checked == true){
    deduction_id.style.display = "block";
     payment_id.style.display = "none";

  } else {
     payment_id.style.display = "block";
    deduction_id.style.display = "none";

  }
}
</script>

<!-- beneficial Field -->
     <div class="form-group col-sm-12">
        <label class="required" for="employee_id">{{ trans('cruds.monthly.fields.beneficial') }}</label>
        <select class="form-control select2 {{ $errors->has('employees') ? 'is-invalid' : '' }}" name="employees"
            id="employee_id" required>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">
                    {{ ucwords($employee->name) }}</option>
            @endforeach
        </select>
        @if ($errors->has('employee'))
            <div class="invalid-feedback">
                {{ $errors->first('employee') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.monthly.fields.beneficial_helper') }}</span>
    </div>



<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Start Date:') !!}
    {!! Form::text('started_at', null, ['class' => 'form-control', 'id' => 'started_at']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#started_at').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush


<!-- ended_at Field -->
<div class="form-group col-sm-6" >
    {!! Form::label('ended_at', 'end_Date:') !!}
    {!! Form::text('ended_at', null, ['class' => 'form-control', 'id' => 'ended_at']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#ended_at').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120, 'id' => 'amount']) !!}
</div>

<div class="form-group col-sm-6">
                <div class="checkbox">
                    <label
                        class="required"
                        for="is_static"
                    >{{ trans('cruds.monthly.fields.is_static') }}</label>
                    <input
                        class="bg-light"
                        id="is_static"
                        name="is_static"
                        type="checkbox"
                        data-toggle="toggle"
                        data-on="YES"
                        data-off="NO"
                        data-size="medium"
                        data-onstyle="success"
                        data-offstyle="light"
                        checked
                    >
                </div>                
            </div>
            

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.monthlies.index') }}" class="btn btn-light">Cancel</a>
</div>


