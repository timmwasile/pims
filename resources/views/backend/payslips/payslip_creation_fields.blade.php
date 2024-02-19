
<!-- salary month Field -->
     <div class="form-group col-sm-4">
        <label class="required" for="salary_id">{{ trans('cruds.monthly.fields.salary') }}</label>
        <select class="form-control select2 {{ $errors->has('salary_id') ? 'is-invalid' : '' }}" name="salary_id"
            id="salary_id" >
              <option></option>
            @foreach ($salaries as $salary)
                <option value="{{ $salary->id }}">
                    {{ date('F Y', strtotime($salary->started_at)) }}</option>
            @endforeach
        </select>
        @if ($errors->has('salary_id'))
            <div class="invalid-feedback">
                {{ $errors->first('salary_id') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.monthly.fields.salary_helper') }}</span>
    </div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.payslips.index') }}" class="btn btn-light">Cancel</a>
</div>
