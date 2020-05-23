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
                    <div class="card-header">Contact's Tags</div>

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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Record Tags</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($contact->records as $record)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <a href="{{route('records.edit',['record'=>$record])}}">{{$record->title}}</a>
                                    </td>
                                    <td>
                                        <div class="tags">
                                            @foreach ($record->tags as $tag)
                                            <span class="tag badge badge-pill badge-primary">
                                                <a href="{{ route('tags.edit', ['tag' => $tag] ) }}">
                                                    {{$tag->name}}
                                                </a>
                                            </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('records.edit',['record'=>$record])}}" class="action-icon"><i
                                                class="fas fa-edit"></i></a>

                                        <form action="{{route('records.destroy',['record' => $record])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="action-icon"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>

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
