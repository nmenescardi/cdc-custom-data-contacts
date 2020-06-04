@props(['colors', 'tag'])

<div class="form-group">
    <div class="select-colors">
        <label for="colors">Select Color:</label>
        <select name="color" id="color" class="form-control">
            @foreach ($colors as $key => $color)
            <option value="{{$key}}" {{
                    (null !== old('color') && old('color') === $key)
                    || (null == old('color') && $tag->color === $key)
                    ? 'selected' : '' }}>{{$color}}</option>
            @endforeach
        </select>
    </div>

    @if( $errors->has('color') )
    <div><span class="text-danger">{{ $errors->first('color') }}</span></div>
    @endif
</div>
