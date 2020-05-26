@extends('layouts.app')

@section('title', 'Contacts')

@section('content')

<div class="contact-list cdc-table">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 cdc-table__main-col">
                <div class="card">
                    <div class="card-header cdc-table__header">
                        <h3 class="d-inline cdc-table__title">Contacts</h3>
                        <a href="{{route('contacts.create')}}" class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($contacts as $contact)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <a
                                            href="{{route('contacts.edit',['contact'=>$contact])}}">{{$contact->name}}</a>
                                    </td>
                                    <td>
                                        <x-tags-list :tagList='$contact->tags' />
                                    </td>
                                    <td class="action-column">
                                        <a href="{{route('contacts.edit',['contact'=>$contact])}}"
                                            class="action-icon"><i class="fas fa-edit"></i></a>

                                        <form action="{{route('contacts.destroy',['contact' => $contact])}}"
                                            method="POST">
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

                        {{ $contacts->links() }}

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
