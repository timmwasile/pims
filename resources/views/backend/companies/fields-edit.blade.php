<!--  Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<!-- Mobile Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_no', 'Mobile Number:') !!}
    {!! Form::text('phone_no', null, ['class' => 'form-control',  'maxlength' => 10, 'maxlength' => 10, 'placeholder'=>'0711101010']) !!}
</div>
    <!-- description Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description :') !!}
    {!! Form::text('description', null, ['class' => 'form-control',  'maxlength' => 120, 'maxlength' => 120, ]) !!}
</div>
   <!-- owner Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner', 'Company Owner :') !!}
    {!! Form::text('owner', null, ['class' => 'form-control',  'maxlength' => 120, 'maxlength' => 120, ]) !!}
</div>
  <!-- contact_person Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_person', 'Company contact_person :') !!}
    {!! Form::text('contact_person', null, ['class' => 'form-control',  'maxlength' => 120, 'maxlength' => 120, ]) !!}
</div>
  <!-- location Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'Company location :') !!}
    {!! Form::text('location', null, ['class' => 'form-control',  'maxlength' => 120, 'maxlength' => 120, ]) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.companies.index') }}" class="btn btn-light">Cancel</a>
</div>
