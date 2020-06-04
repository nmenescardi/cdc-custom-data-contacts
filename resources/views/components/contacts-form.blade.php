@props(['nameValue', 'allTags', 'buttonLabel', 'isActive'])

<div class="form-group">
    <label class="control-label" for="name">Name: </label>
    <input type="text" name="name" id="name" placeholder="Name" value="{{ $nameValue }}" required
        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

    @if( $errors->has('name') )
    <div><span class="text-danger">{{ $errors->first('name') }}</span></div>
    @endif
</div>

<div class="form-group">
    <label class="control-label" for="active">Active: </label>

    <select name="active" id="active" class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}">
        <option value="1" {{ $isActive ? 'selected' : '' }}>Active</option>
        <option value="0" {{ ! $isActive ? 'selected' : '' }}>Inactive</option>
    </select>

    @if( $errors->has('active') )
    <div><span class="text-danger">{{ $errors->first('active') }}</span></div>
    @endif
</div>

<x-existing-tags-field :allTags="$allTags" />

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
