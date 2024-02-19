<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('FullName', 'Company Name:') !!}
    <p>{{ ucwords($license->companyId->name) }}</p>
</div>

<!-- started_at Field -->
<div class="form-group">
    {!! Form::label('started_at', 'Started At:') !!}
    <p>{{ $license->started_at }}</p>
</div>

<!-- ended_at Field -->
<div class="form-group">
    {!! Form::label('ended_at', 'Ended At:') !!}
    <p>{{ $license->ended_at }}</p>
</div>

<!-- status_id Field -->
<div class="form-group">
    {!! Form::label('status_id', 'Status:') !!}
    <p>
    <div class="badge badge-secondary">{{ $license->status_is==1?'Active':'Experied' }}</div>
    </p>
</div>
