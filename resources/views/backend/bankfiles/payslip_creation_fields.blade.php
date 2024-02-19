 <!-- salary month Field -->
     <div class="form-group col-sm-4">
        <label class="required" for="started_at">{{ trans('cruds.monthly.fields.salary') }}</label>
        <select class="form-control select2 {{ $errors->has('started_at') ? 'is-invalid' : '' }}" name="started_at"
            id="started_at" >
            @foreach ($salaries as $salary)
                <option value="{{ $salary->id }}">
                    {{ date('F Y', strtotime($salary->started_at)) }}</option>
            @endforeach
        </select>
        @if ($errors->has('started_at'))
            <div class="invalid-feedback">
                {{ $errors->first('started_at') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.monthly.fields.salary_helper') }}</span>
    </div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.payslips.index') }}" class="btn btn-light">Cancel</a>
</div>
