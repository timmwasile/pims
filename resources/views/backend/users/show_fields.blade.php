<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('FullName', 'Full Name:') !!}
    <p>{{ ucwords($user->name) }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'E-mail:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $user->username }}</p>
</div>

<!-- Nida Field -->
<div class="form-group">
    {!! Form::label('nida', 'Nida Number:') !!}
    <p>{{ $info->nin ? $info->nin : '(Not Set)' }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Candidate Full Address:') !!}
    <p>{{ $info->address ? $info->address : '(Not Set)' }}</p>
</div>

<!-- dob Field -->
<div class="form-group">
    {!! Form::label('address', 'Date of Birth:') !!}
    <p>{{ $info->dob ? $info->dob : '(Not Set)' }}</p>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created On:') !!}
    <p>{{ $info->created_at ? $info->created_at : '(Not Set)' }}</p>
</div>
{{-- <!-- Roles Field -->
<div class="form-group">
    {!! Form::label('roles', 'Roles:') !!}
    <p>
        @foreach ($admin->roles as $key => $roles)
            <div class="badge badge-info">{{ ucwords($roles->title) }}</div>
        @endforeach
    </p>
</div> --}}

<!-- gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($user->gender) }}</div>
    </p>
</div>
