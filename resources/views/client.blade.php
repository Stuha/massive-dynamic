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
        <p>
        @if(in_array(\App\Enums\PermissionEnum::Edit->value, $userPermissions))
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
        </p>
        @if(in_array(\App\Enums\PermissionEnum::Edit->value, $userPermissions))
            <p>
            <h3>Assigned Documents</h3>
            @foreach($assignedFiles as $assignedFile)
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$assignedFile?->filename}}</li>
            </ul>
            @endforeach
            </p>
            @if(count($unassignedFiles) >0)
            <p>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
                Assign documet to client
            </button>
            </p>
            
            <div class="collapse dropdown-menu" id="menu">
                @foreach($unassignedFiles as $unassignedFile)
                <form method="post" action="{{ route('assign-file', ['id' => $unassignedFile->id, 'assigned' => true]) }}">
                @csrf
                    <input type="submit" name="submit" value="{{$unassignedFile->filename}}">
                </form>
                @endforeach
            </div>
            @else
            <div>There are no unassigned files for this client</div>
            @endif
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
</div>
@endsection