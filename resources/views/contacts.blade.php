@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Contact</div>

                <div class="card-body">
                    <form action="contacts" method="POST">
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="Name" class="form-control">
                        </div>
                        <div>{{ $errors->first('name')}}</div>
                        <button type="submit" class="btn btn-primary">Add Contact</button>

                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contacts</div>

                <div class="card-body">
                    <ul>
                        @foreach ($contacts as $contact)
                            <li>{{$contact->name}}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
