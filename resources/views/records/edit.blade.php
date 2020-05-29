@extends('layouts.app')

@section('title', 'Edit Record')

@section('content')
<div class="record-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 cdc-table__main-col">
                <div class="card">

                    <x-table-header title="Edit Record" />

                    <div class="card-body">
                        <form action="{{ route('records.update', ['record' => $record]) }}" method="POST">
                            @method('PATCH')

                            <x-records-form :record="$record" :allTags="$allTags" buttonLabel="Save Record"
                                :contacts="$contacts" />

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
