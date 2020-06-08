@props(['nameValue', 'allTags', 'buttonLabel', 'isActive'])

<div class="form-group">
  <label class="control-label" for="name">Name: </label>
  <input type="text" name="name" id="name" placeholder="Name" value="{{ $nameValue }}" required
    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

  @error('name')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<div class="form-group">
  <label class="control-label" for="active">Active: </label>

  <select name="active" id="active" class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}">
    <option value="1" {{ $isActive ? 'selected' : '' }}>Active</option>
    <option value="0" {{ ! $isActive ? 'selected' : '' }}>Inactive</option>
  </select>

  @error('active')<div><span class="text-danger">{{ $message }}</span></div>@enderror
</div>

<x-existing-tags-field :allTags="$allTags" />

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>

@csrf
