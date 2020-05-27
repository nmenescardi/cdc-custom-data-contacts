@extends('layouts.app')

@section('title', 'Add Contact')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 cdc-table__main-col">
            <div class="card">

                <x-table-header title="Add Contact" />

                <div class="card-body">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="name">Name: </label>
                            <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}"
                                required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                            @if( $errors->has('name') )
                            <div><span class="text-danger">{{ $errors->first('name') }}</span></div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="add-tags">
                                <label for="tags">Add Tags:</label>
                                <select name="tag_list[]" id="tags" class="form-control" multiple="multiple">
                                    @foreach ($allTags as $key => $tag)
                                    <option value="{{$key}}">{{$tag}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Contact</button>

                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
