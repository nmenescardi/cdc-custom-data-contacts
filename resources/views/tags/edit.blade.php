@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="tag-edit cdc-table">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-3 cdc-table__main-col">
        <div class="card">

          <x-table-header title="Edit Tag" :route="route('tags.create')" />

          <div class="card-body">
            <form action="{{ route('tags.update', ['tag' => $tag]) }}" method="POST">
              @method('PATCH')
              <div class="form-group">
                <label class="control-label" for="name">Name: </label>
                <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') ?? $tag->name }}"
                  required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                @error('name')<div><span class="text-danger">{{ $message }}</span></div>@enderror
              </div>

              <x-colors-selector :colors='$colors' :tag='$tag' />

              <button type="submit" class="btn btn-primary">Save Tag</button>

              @csrf
            </form>
          </div>

        </div>
      </div>

      <div class="col-md-3 cdc-table__main-col">
        <div class="card">

          <x-table-header title="Contacts" :route="route('contacts.create')" />

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($tag->contacts as $contact)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>
                    <a href="{{route('contacts.edit',['contact'=>$contact])}}">{{$contact->name}}</a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>

          </div>

        </div>
      </div>

      <div class="col-md-3 cdc-table__main-col records-table">
        <div class="card">

          <x-table-header title="Records" :route="route('records.create')" />

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($tag->records as $record)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>
                    <a href="{{route('records.edit',['record'=>$record])}}">{{$record->title}}</a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>

          </div>

        </div>
      </div>

      <div class="col-md-3 cdc-table__main-col stories-table">
        <div class="card">

          <x-table-header title="Stories" :route="route('stories.create')" />

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($tag->stories as $story)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>
                    <a href="{{route('stories.edit',['story'=>$story])}}">{{$story->title}}</a>
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
