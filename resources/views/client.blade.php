@extends('layouts.app')
@section('content')
<div class="card">
    <h5 class="card-header">{{$client->name}}</h5>
    <div class="card-body">
        <div class="card-title"></div>
        <div class="card-header">Address</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$client->address}}</li>
        </ul>
        @foreach($client->contactPerson as $value)
        <div class="card-header">Contact person</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$value->name}}</li>
            <li class="list-group-item">{{$value->phone_number}}</li>
        </ul>
        @endforeach
        <div class="card-header">Email</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$client->email}}</li>
        </ul>

        <div class="btn-group me-2 ">
            <a href="{{ route('update', ['uuid' => $client->client_uuid]) }}" class="btn btn-primary ml-2">Edit</a>
        </div>

        <div class="btn-group me-2">
            <form method="POST" action="{{ route('delete', $client->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection