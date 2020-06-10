@extends('layouts.app')

@section('title', 'Add Story')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 cdc-table__main-col">
            <div class="card">

                <x-table-header title="Add Story" />

                <div class="card-body">
                    <form action="{{ route('stories.store') }}" method="POST">

                        <x-stories-form :story="$story" buttonLabel="Add Story" />

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
