<!-- Full Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'full Name:') !!}
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
    {!! Form::text('phone_no', null, [
        'class' => 'form-control',
        'maxlength' => 10,
        'placeholder' => '(0)712-123-456',
    ]) !!}
</div>

{{-- <div class="form-row"> --}}
<div class="form-group col-md-6">
    <label class="required" for="gender">{{ trans('cruds.user.fields.gender') }}</label>
    <select class="form-control select2 {{ $errors->has('genders') ? 'is-invalid' : '' }}" name="genders[]" id="roles"
        required>
        @foreach ($genders as $gender)
            <option value="{{ $gender->id }}">
                {{ ucwords($gender->title) }}</option>
        @endforeach
    </select>
    @if ($errors->has('gender'))
        <div class="invalid-feedback">
            {{ $errors->first('gender') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
</div>
{{-- </div> --}}


<div class="form-group col-md-4">
    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
    <div style="padding-bottom: 4px">
        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all"
            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
    </div>
    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles"
        multiple required>
        @foreach ($roles as $id => $roles)
            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                {{ $roles }}</option>
        @endforeach
    </select>
    @if ($errors->has('roles'))
        <div class="invalid-feedback">
            {{ $errors->first('roles') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.companies.index') }}" class="btn btn-light">Cancel</a>
</div>
