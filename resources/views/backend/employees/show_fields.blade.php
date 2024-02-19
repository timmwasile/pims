<div class="row">

<!-- FullName Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Full Name:') !!}
   <div class = 'form-control'> {{ $Employee->name }}</div>
</div>

<!-- email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'email:') !!}
   <div class = 'form-control'> {{ $Employee->email }}</div>
</div>

<!-- number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'number:') !!}
   <div class = 'form-control'> {{ $Employee->number }}</div>
</div>

<!-- dob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dob', 'Date of Birth:') !!}
   <div class = 'form-control'> {{ $Employee->dob }}</div>
</div>

<!-- employment_date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employment_date', 'employment_date:') !!}
  <div class = 'form-control'>  {{ $Employee->employment_date }}</div>
</div>

<!-- jobtitle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jobtitle', 'jobtitle:') !!}
  <div class = 'form-control'>  {{ $Employee->JobtitleName->name }}</div>
</div>

<!-- office_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('office_name', 'office_name:') !!}
  <div class = 'form-control'>  {{ $Employee->OfficeName->name }}</div>
</div>

<!-- basic_salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('basic_salary', 'Basic Salary:') !!}
 <div class = 'form-control'>   {{ $Employee->basic_salary }}</div>
</div>
<!-- phone_no Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_no', 'Mobile Number:') !!}
 <div class = 'form-control'>   {{ $Employee->phone_no }}</div>
</div>
<!-- bank_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_name', 'bank_name:') !!}
 <div class = 'form-control'>   {{ $Employee->BankName->name }}</div>
</div>

<!-- bank_account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_account', 'bank_account:') !!}
  <div class = 'form-control'>  {{ $Employee->bank_account }}</div>
</div>

<!-- gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'gender:') !!}
  <div class = 'form-control'>  {{ $Employee->GenderName->name }}</div>
</div>

<!-- created_by Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
 <div class = 'form-control'>   {{ ucwords($Employee->createdBy->name) }}</div>
</div>

<!-- status_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Status:') !!}
  <div class = 'form-control'>  {{ $Employee->status_id }}</div>
</div>
</div>