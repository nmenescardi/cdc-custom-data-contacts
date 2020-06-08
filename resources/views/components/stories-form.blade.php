@props(['story', 'allTags', 'buttonLabel'])


<div class="form-group">
  <label class="control-label" for="title">Title: </label>
  <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') ?? $story->title }}" required
    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

  @error('title')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<x-existing-tags-field :allTags="$allTags" />

<div class="form-group">
  <label class="control-label" for="days_to_expire">Days To Expire: </label>

  <input type="number" name="days_to_expire" placeholder="Number of Days" id="days_to_expire"
    value="{{ old('days_to_expire') ?? $story->days_to_expire }}" required
    class="form-control {{ $errors->has('days_to_expire') ? 'is-invalid' : '' }}">

  @error('days_to_expire')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<div class="form-group">
  <label class="control-label" for="description">Description: </label>
  <textarea name="description" id="description" placeholder="description" rows="10"
    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') ?? $story->description }}</textarea>

  @error('description')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
