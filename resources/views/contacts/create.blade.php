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

                        <x-contacts-form :nameValue="old('name')" :allTags="$allTags" :isActive="old('active') ?? 1"
                            buttonLabel="Add Contact" />

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
