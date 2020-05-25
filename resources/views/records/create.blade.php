@extends('layouts.app')

@section('title', 'Create new Record')

@section('content')
<div class="record-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 cdc-table__main-col">
                <div class="card">
                    <div class="card-header">Create new Record</div>

                    <div class="card-body">
                        <form action="{{ route('records.store') }}" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="name">Title: </label>
                                <input type="text" name="title" id="title" placeholder="title"
                                    value="{{ old('title') ?? $record->title }}" required
                                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

                                @if( $errors->has('title') )
                                <div><span class="text-danger">{{ $errors->first('title') }}</span></div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="contact_id">Contact</label>
                                <select name="contact_id" id="contact_id" class="form-control">
                                    @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}"
                                        {{ $contact->id == $prefilledContact ? 'selected' : '' }}>
                                        {{ $contact->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">Description: </label>
                                <textarea name="description" id="description" placeholder="description" rows="10"
                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') ?? $record->description }}</textarea>

                                @if( $errors->has('description') )
                                <div><span class="text-danger">{{ $errors->first('description') }}</span></div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Save Record</button>

                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
