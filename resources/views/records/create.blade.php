@extends('layouts.app')

@section('title', 'Create new Record')

@section('content')
<div class="record-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 cdc-table__main-col">
                <div class="card">
                    <x-table-header title="Create new Record" />

                    <div class="card-body">
                        <form action="{{ route('records.store') }}" method="POST">

                            <x-records-form :record="$record" buttonLabel="Add Record" :contacts="$contacts" :prefilledContact="$prefilledContact" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
