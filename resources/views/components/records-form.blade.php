@props(['record', 'contacts', 'allTags', 'buttonLabel'])


<div class="form-group">
    <label class="control-label" for="title">Title: </label>
    <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') ?? $record->title }}" required
        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @if( $errors->has('title') )
    <div><span class="text-danger">{{ $errors->first('title') }}</span></div>
    @endif
</div>

<x-contacts-list :contacts="$contacts" :selectedContactID="$record->contact_id" />

<x-existing-tags-field :allTags="$allTags" />

<div class="form-group">
    <label class="control-label" for="name">Description: </label>
    <textarea name="description" id="description" placeholder="description" rows="10"
        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') ?? $record->description }}</textarea>

    @if( $errors->has('description') )
    <div><span class="text-danger">{{ $errors->first('description') }}</span></div>
    @endif
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
