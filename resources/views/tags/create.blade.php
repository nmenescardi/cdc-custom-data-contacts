@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
<div class="tag-create cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 cdc-table__main-col">
                <div class="card">
                    <div class="card-header cdc-table__header">
                        <div class="d-inline cdc-table__title">Add new Tags</div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tags.store') }}" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="name">Name: </label>
                                <input type="text" name="name" id="name" placeholder="Name"
                                    value="{{ old('name') ?? $tag->name }}" required
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                                @if( $errors->has('name') )
                                <div><span class="text-danger">{{ $errors->first('name') }}</span></div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Save Tag</button>

                            @csrf
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
