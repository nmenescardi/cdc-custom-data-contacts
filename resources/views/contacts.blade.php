@extends('layout.app')

@section('content')
<div class="container">
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
