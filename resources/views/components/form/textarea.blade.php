<div class="form-group">
    <label>{{ ucwords($name) }}</label>
    <div class="input-with-gray ">
        <textarea
            id="{{ $name }}"
            type="{{ isset($type) ? $type : 'text' }}"
            class="form-control"
            name="{{ $name }}"
            placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
            value="{{ old($name) ?: (isset($object) ? $object->{$name} : '') }}"
            {{ ucwords(isset($attributes) ? $attributes : '') }}
>
{{ old($name) ?: (isset($object) ? $object->{$name} : '') }}
</textarea>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif

    </div>
</div>
