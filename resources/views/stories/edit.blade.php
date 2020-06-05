@extends('layouts.app')

@section('title', 'Edit Story')

@section('content')
<div class="story-edit cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 cdc-table__main-col">
                <div class="card">

                    <x-table-header title="Edit Story" />

                    <div class="card-body">
                        <form action="{{ route('stories.update', ['story' => $story]) }}" method="POST">
                            @method('PATCH')

                            <x-stories-form :story="$story" :allTags="$allTags" buttonLabel="Save Story" />

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
