@extends('layouts.app')

@section('title', 'Contacts')

@section('content')

<div class="contact-list cdc-table">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($contacts as $contact)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$contact->name}}</td>
                                    <td>
                                        <a href="#" class="action-icons"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="action-icons"><i class="fas fa-trash-alt"></i></a>
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
