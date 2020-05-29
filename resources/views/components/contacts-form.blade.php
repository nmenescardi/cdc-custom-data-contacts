@props(['nameValue', 'allTags', 'buttonLabel'])

<div class="form-group">
    <label class="control-label" for="name">Name: </label>
    <input type="text" name="name" id="name" placeholder="Name" value="{{ $nameValue }}" required
        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

    @if( $errors->has('name') )
    <div><span class="text-danger">{{ $errors->first('name') }}</span></div>
    @endif
</div>

<div class="form-group">
    <div class="add-tags">
        <label for="tags">Add Tags:</label>
        <select name="tag_list[]" id="tags" class="form-control" multiple="multiple">
            @foreach ($allTags as $key => $tag)
            <option value="{{$key}}">{{$tag}}</option>
            @endforeach
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
