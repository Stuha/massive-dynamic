@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Clients
                </div>
                <ul class="list-group list-group-flush">
                @foreach($clients as $client) 
                <a class="text-decoration-none" href="{{ route('client', ['uuid' => $client->client_uuid]) }}" 
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Click to view details">
                    <li class="list-group-item">{{$client->name}}</li>
                </a>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
