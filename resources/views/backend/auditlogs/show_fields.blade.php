<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('id', 'ID:') !!}
    <p>{{ $auditlog->id }}</p>
</div>

<!-- description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $auditlog->description }}</p>
</div>

<!-- subject id Field -->
<div class="form-group">
    {!! Form::label('subject_id', 'Subject_id:') !!}
    <p>{{ $auditlog->subject_id }}</p>
</div>

<!-- subject_type Field -->
<div class="form-group">
    {!! Form::label('subject_type', 'subject_type:') !!}
    <p>
        {{ $auditlog->subject_type }}
    </p>
</div>

<!-- user_id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Created By:') !!}
    <p>
        {{ ucwords($auditlog->admin->name) }}
    </p>
</div>

<!-- properties Field -->
<div class="form-group">
    {!! Form::label('properties', 'Properties:') !!}
    <p>
        {{ $auditlog->properties }}
    </p>
</div>

<!-- host Field -->
<div class="form-group">
    {!! Form::label('host', 'Host:') !!}
    <p>
        {{ $auditlog->host }}
    </p>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', 'created_at:') !!}
    <p>
        {{ $auditlog->created_at }}
    </p>
</div>

<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'updated_at:') !!}
    <p>
        {{ $auditlog->updated_at }}
    </p>
</div>
