@props(['nameValue', 'allTags', 'buttonLabel'])

<div class="form-group">
    <label class="control-label" for="name">Name: </label>
    <input type="text" name="name" id="name" placeholder="Name" value="{{ $nameValue }}" required
        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

    @if( $errors->has('name') )
    <div><span class="text-danger">{{ $errors->first('name') }}</span></div>
    @endif
</div>

<x-existing-tags-field :allTags="$allTags" />

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
