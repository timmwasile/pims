<div class="form-group">
    <label>{{ ucwords($name) }}</label>
    <div class="input-with-gray ">
        <input id="{{ $name }}" type="{{ isset($type) ? $type : 'text' }}" class="form-control"
            name="{{ $name }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" value=""
            {{ ucwords(isset($attributes) ? $attributes : '') }}>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
        <i class="ti-user theme-cl"></i>
    </div>
</div>
