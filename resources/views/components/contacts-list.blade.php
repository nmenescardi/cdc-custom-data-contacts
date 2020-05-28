@props(['contacts', 'selectedContactID'])

<div class="form-group">
    <label class="control-label" for="contact_id">Contact</label>
    <select name="contact_id" id="contact_id" class="form-control">
        @foreach ($contacts as $contact)
        <option value="{{ $contact->id }}" {{ $contact->id == $selectedContactID ? 'selected' : '' }}>
            {{ $contact->name }}</option>
        @endforeach
    </select>
</div>
