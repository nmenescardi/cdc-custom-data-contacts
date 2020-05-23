@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
<div class="contact-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 cdc-table__main-col">
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

            <div class="col-md-6 cdc-table__main-col">
                <div class="card">
                    <div class="card-header">Tags</div>

                    <div class="card-body">
                        <div class="tags">
                            @foreach ($contact->tags as $tag)
                            <span class="tag badge badge-pill badge-primary">{{$tag->name}}</span>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 cdc-table__main-col mt-5">
                <div class="card">
                    <div class="card-header">Records</div>

                    <div class="card-body">
                        <div class="records">
                            @foreach ($contact->records as $record)
                            <span class="record">{{$record->title}}</span>
                            <span class="record">{{-- {{$record->description}} --}}</span>
                            <br />
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
