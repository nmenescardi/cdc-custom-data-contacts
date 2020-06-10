@props(['record', 'contacts', 'buttonLabel'])


<div class="form-group">
    <label class="control-label" for="title">Title: </label>
    <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') ?? $record->title }}" required
        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @error('title')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<x-contacts-list :contacts="$contacts" :selectedContactID="$record->contact_id" />

<x-existing-tags-field />

<div class="form-group">
    <label class="control-label" for="name">Description: </label>
    <textarea name="description" id="description" placeholder="description" rows="10"
        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') ?? $record->description }}</textarea>

    @error('description')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
