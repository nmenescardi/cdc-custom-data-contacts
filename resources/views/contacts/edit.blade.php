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

                            <x-contacts-form :nameValue="old('name') ?? $contact->name" :allTags="$allTags"
                                buttonLabel="Save Contact" />

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
                                    <td>
                                        <x-action-icons :routeEdit="route('records.edit',['record'=>$record])"
                                            :routeDelete="route('records.destroy',['record' => $record])" />
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
