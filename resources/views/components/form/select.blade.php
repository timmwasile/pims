<div class="form-group">
    <label>{{ ucwords($name) }}</label>
    <div class="input-with-gray ">
        <select
            class="form-control select {{ $errors->has($name) ? 'is-invalid' : '' }}"
            name="{{ $name }}"
            id="{{ $name }}"
            required
        >
            <option value="">{{ trans('global.pleaseSelect') }}</option>
            {{-- @foreach ($object as $key => $name) --}}
            <option value="{{ old($name) ?: (isset($name) ? $name : '') }}">
                {{ ucwords($name) }}</option>
            {{-- @endforeach --}}
        </select>
        @if ($errors->has($name))
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        @endif
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>


    </div>
</div>
