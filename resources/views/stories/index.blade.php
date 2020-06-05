@extends('layouts.app')

@section('title', 'Stories')

@section('content')

<div class="story-list cdc-table">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 cdc-table__main-col">
                <div class="card">

                    <x-table-header title='Stories' :route="route('stories.create')" />

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($stories as $story)
                                <tr>
                                    <th scope="row">{{$loop->iteration + $paginationOffset}}</th>
                                    <td>
                                        <a href="{{route('stories.edit',['story'=>$story])}}">{{$story->title}}</a>
                                    </td>
                                    <td>
                                        <x-tags-list :tagList='$story->tags' />
                                    </td>
                                    <td>
                                        {{$story->days_to_expire}}
                                    </td>
                                    <td>
                                        <x-action-icons :routeEdit="route('stories.edit',['story'=>$story])"
                                            :routeDelete="route('stories.destroy',['story' => $story])" />
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $stories->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
