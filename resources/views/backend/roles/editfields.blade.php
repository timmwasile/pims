<!-- Title Field -->
<div class="form-group col-sm-8">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>

<div class="form-group col-sm-8">
    <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
    <div style="padding-bottom: 4px">
        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
    </div>
    <select
                    class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}"
                    name="permissions[]"
                    id="permissions"
                    multiple
                    required
                >
                    @foreach($permissions as $id => $permissions)
                    <option
                        value="{{ $id }}"
                        {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}
                    >{{ $permissions }}</option>
                    @endforeach
                </select>
    @if ($errors->has('permissions'))
        <div class="invalid-feedback">
            {{ $errors->first('permissions') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.roles.index') }}" class="btn btn-light">Cancel</a>
</div>
