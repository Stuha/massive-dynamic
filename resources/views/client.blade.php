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

        @if(in_array(\App\Enums\PermissionEnum::Edit->value, $userPermissions))
        <div class="container">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Dropdown Example
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HTML</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>    
                </ul>
            </div>
        </div>

        <div class="btn-group me-2 ">
            <a href="{{ route('update', ['uuid' => $client->client_uuid]) }}" class="btn btn-primary ml-2">Edit</a>
        </div>
        @endif 
        @if(in_array( \App\Enums\PermissionEnum::Delete->value, $userPermissions))
        <div class="btn-group me-2">
            <form method="POST" action="{{ route('delete', $client->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
  
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(in_array( \App\Enums\PermissionEnum::Read->value, $userPermissions))
        <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
  
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control">
                </div>
   
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
   
            </div>
        </form>
        @endif
    </div>
    <script>
        $(document).ready(function(){
            console.log($(".dropdown-toggle").dropdown())
            $(".dropdown-toggle").dropdown();
        });
    </script>
</div>
@endsection