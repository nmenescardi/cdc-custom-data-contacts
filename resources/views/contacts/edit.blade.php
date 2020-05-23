@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 cdc-table__main-col">
            <div class="card">
                <div class="card-header">Edit Contact</div>

                <div class="card-body">
                    <form action="{{ route('contacts.update', ['contact' => $contact]) }}" method="POST">
                        @method('PATCH')
                        <div class="form-group">
                            <label class="control-label" for="name">Name: </label>
                            <input type="text" name="name" id="name" placeholder="Name"
                                value="{{ old('name') ?? $contact->name }}" required
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                            @if( $errors->has('name') )
                            <div><span class="text-danger">{{ $errors->first('name') }}</span></div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Save Contact</button>

                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
