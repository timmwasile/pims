<!-- FullName Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Full Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
     @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- dob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dob', 'Date of Birth:') !!}
    {!! Form::text('dob', null, ['class' => 'form-control', 'id' => 'dob', 'autcomplete'=>'off']) !!}
      @error('dob')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- employment_date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employment_date', 'Employment Date:') !!}
    {!! Form::text('employment_date', null, ['class' => 'form-control', 'id' => 'employment_date']) !!}
      @error('employment_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
      @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- jobtitle Id Field -->


<div class="form-group col-sm-6">
    {!! Form::label('jobtitle_id', 'Job Title:') !!}
    {{ Form::select('jobtitle_id', $jobtitles, null, ['class' => 'form-control select2', 'name' => 'jobtitle_id']) }}
 @error('jobtitle_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>


<!-- officename Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('office_id', 'Office Name:') !!}
    {{ Form::select('office_id', $offices, null, ['class' => 'form-control select2', 'name' => 'office_id']) }}
 @error('office_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>


<!-- basic_salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('basic_salary', 'basic_salary:') !!}
    {!! Form::text('basic_salary', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120, 'name'=>'basic_salary']) !!}
      @error('basic_salary')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>


<!-- bank_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_id', 'Bank Name:') !!}
    {{ Form::select('bank_id', $banks, null, ['class' => 'form-control select2', 'name' => 'bank_id']) }}
 @error('bank_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>



<!-- bank_account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_account', 'bank_account:') !!}
    {!! Form::text('bank_account', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
      @error('bank_account')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>


<!-- gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender_id', 'Gender:') !!}
    {{ Form::select('gender_id', $genders, null, ['class' => 'form-control select2', 'name' => 'gender_id']) }}
 @error('gender_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.employees.index') }}" class="btn btn-light">Cancel</a>
</div>
