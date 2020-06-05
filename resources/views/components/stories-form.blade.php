@props(['story', 'allTags', 'buttonLabel'])


<div class="form-group">
    <label class="control-label" for="title">Title: </label>
    <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') ?? $story->title }}" required
        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @if( $errors->has('title') )
    <div><span class="text-danger">{{ $errors->first('title') }}</span></div>
    @endif
</div>

<x-existing-tags-field :allTags="$allTags" />

<div class="form-group">
    <label class="control-label" for="days_to_expire">Days To Expire: </label>

    <input type="number" name="days_to_expire" placeholder="Number of Days" id="days_to_expire"
        value="{{ old('days_to_expire') ?? $story->days_to_expire }}" required
        class="form-control {{ $errors->has('days_to_expire') ? 'is-invalid' : '' }}">

    @if( $errors->has('days_to_expire') )
    <div><span class="text-danger">{{ $errors->first('days_to_expire') }}</span></div>
    @endif
</div>

<div class="form-group">
    <label class="control-label" for="description">Description: </label>
    <textarea name="description" id="description" placeholder="description" rows="10"
        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') ?? $story->description }}</textarea>

    @if( $errors->has('description') )
    <div><span class="text-danger">{{ $errors->first('description') }}</span></div>
    @endif
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
