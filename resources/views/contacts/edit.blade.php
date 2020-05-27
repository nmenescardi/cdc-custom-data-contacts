@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
<div class="contact-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 cdc-table__main-col">
                <div class="card">

                    <x-table-header title="Edit Contact" />

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

                            <button type="submit" class="btn btn-primary">Save Contact</button>

                            @csrf
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-6 cdc-table__main-col">
                <div class="card">

                    <x-table-header title="Contact's Tags" :route="route('tags.create')" />

                    <div class="card-body">
                        <x-tags-list :tagList='$contact->tags' />
                    </div>

                </div>
            </div>

            <div class="col-12 cdc-table__main-col mt-5 records-table">
                <div class="card">

                    <x-table-header title="Records"
                        :route="route('records.create', ['prefilledContact' => $contact->id])" />

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Tags</th>
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
                                        <x-tags-list :tagList='$record->tags' />
                                    </td>
                                    <td class="action-column">
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
