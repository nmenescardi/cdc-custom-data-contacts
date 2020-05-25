@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
<div class="tag-create cdc-table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 cdc-table__main-col">
                <div class="card">
                    <div class="card-header cdc-table__header">
                        <div class="d-inline cdc-table__title">Add new Tags</div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tags.store') }}" method="POST">

                            <div class="form-group">
                                <div class="add-tags">
                                    <label for="tags">Add Tags:</label>
                                    <select name="tag_list[]" id="tags" class="form-control" multiple="multiple"
                                        data-new-tags='true'>
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
