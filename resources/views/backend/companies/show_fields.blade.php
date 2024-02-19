<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('FullName', 'Full Name:') !!}
    <p>{{ ucwords($company->name) }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'E-mail:') !!}
    <p>{{ $company->email }}</p>
</div>

<!-- location Field -->
<div class="form-group">
    {!! Form::label('location', 'Location:') !!}
    <p>{{ $company->location }}</p>
</div>

<!-- owner Field -->
<div class="form-group">
    {!! Form::label('owner', 'Business Owner:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($company->owner) }}</div>
    </p>
</div>

<!-- phone_no Field -->
<div class="form-group">
    {!! Form::label('phone_no', 'Business phone_no:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($company->phone_no) }}</div>
    </p>
</div>

<!-- contact_person Field -->
<div class="form-group">
    {!! Form::label('contact_person', 'Business Contact_person:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($company->contact_person) }}</div>
    </p>
</div>

<!-- description Field -->
<div class="form-group">
    {!! Form::label('description', 'Business description:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($company->description) }}</div>
    </p>
</div>