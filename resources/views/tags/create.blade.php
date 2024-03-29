@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
<div class="tag-create cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 cdc-table__main-col">
                <div class="card">

                    <x-table-header title="Add new Tags" />

                    <div class="card-body">
                        <form action="{{ route('tags.store') }}" method="POST">

                            <div class="form-group">
                                <div class="add-tags">
                                    <label for="tags">Add Tags:</label>
                                    <select name="tag_list[]" id="tags" class="form-control" multiple="multiple"
                                        data-new-tags='true' required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>

                            @csrf
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
