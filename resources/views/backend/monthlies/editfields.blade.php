<!-- loadnDescription Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Monthly Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Monthly date:') !!}
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
<div class="form-group col-sm-6" style="display: none">
    {!! Form::label('ended_at', 'Monthly end_Date:') !!}
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

<!-- monthly_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monthly_balance', 'monthly_balance:') !!}
    {!! Form::text('monthly_balance', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- monthly_balance Field -->
<div class="form-group col-sm-6" style="display: none">
    {!! Form::label('monthly_balance', 'monthly_balance:') !!}
    {!! Form::text('monthly_balance', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'Rate:') !!}
    {!! Form::text('rate', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'duration:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- employee_id Field -->


<div class="form-row">
    <div class="form-group col-md-6">
        <label class="required" for="employee_id">{{ trans('cruds.user.fields.monthly_applicant') }}</label>
        <select class="form-control select2 {{ $errors->has('employees') ? 'is-invalid' : '' }}" name="employees[]"
            id="roles" required>
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
        <span class="help-block">{{ trans('cruds.user.fields.mothly_applicant_helper') }}</span>
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.monthlies.index') }}" class="btn btn-light">Cancel</a>
</div>
