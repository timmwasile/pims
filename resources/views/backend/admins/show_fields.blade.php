<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('FullName', 'Full Name:') !!}
    <p>{{ ucwords($admin->name) }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'E-mail:') !!}
    <p>{{ $admin->email }}</p>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $admin->username }}</p>
</div>

<!-- Roles Field -->
<div class="form-group">
    {!! Form::label('roles', 'Roles:') !!}
    <p>
        @foreach ($admin->roles as $key => $roles)
            <div class="badge badge-info">{{ ucwords($roles->title) }}</div>
        @endforeach
    </p>
</div>

<!-- gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($admin->genderId->name) }}</div>
    </p>
</div>

<!-- company Field -->
<div class="form-group">
    {!! Form::label('company', 'company:') !!}
    <p>
    <div class="badge badge-secondary">{{ ucwords($admin->companyId->name) }}</div>
    </p>
</div>
