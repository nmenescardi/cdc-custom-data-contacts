@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="tag-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 cdc-table__main-col">
                <div class="card">
                    <div class="card-header">Edit Tag</div>

                    <div class="card-body">
                        <form action="{{ route('tags.update', ['tag' => $tag]) }}" method="POST">
                            @method('PATCH')
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

            <div class="col-md-4 cdc-table__main-col">
                <div class="card">
                    <div class="card-header">Contacts</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tag->contacts as $contact)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <a
                                            href="{{route('contacts.edit',['contact'=>$contact])}}">{{$contact->name}}</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

            <div class="col-md-4 cdc-table__main-col records-table">
                <div class="card">
                    <div class="card-header cdc-table__header">
                        <div class="d-inline cdc-table__title">Records</div>
                        <a href="{{route('records.create')}}" class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tag->records as $record)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <a href="{{route('records.edit',['record'=>$record])}}">{{$record->title}}</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
