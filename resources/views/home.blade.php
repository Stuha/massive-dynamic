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
                @foreach($clients as $key => $client) 
                <a class="text-decoration-none" href="{{ route('client', ['uuid' => $clients[$key]->client_uuid]) }}" 
                    title="Click to view details">
                    <li class="list-group-item">{{$client->name}}</li>
                </a>
                <br>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @if(count($clients) > 1)
        {{$clients->links() }}
    @endif
</div>
@endsection
