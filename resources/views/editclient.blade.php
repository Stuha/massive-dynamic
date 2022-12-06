@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$client->id}}">
                        <input type="hidden" name="uuid" value="{{$client->client_uuid}}">
            
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$client->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ $client->address }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @foreach($contactPeople as $key => $value)
                        <div class="row mb-3 " >
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }} {{$key === 0 ? '' : $key}}</label>

                            <div class="col-md-6">
                                <input id="contact{{$key}}" type="text" class="form-control @error('contact{{$key}}') is-invalid @enderror" name="contacts[]" value="{{$contactPeople[$key]['name']}}" autocomplete="contact{{$key}}" autofocus>
                                <input id="phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumbers[]" value="{{$contactPeople[$key]['phone_number']}}" placeholder="Add contact number"  autocomplete="name" autofocus>

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <input id="admin" type="radio" class="form-check-input @error('role') is-invalid @enderror" name="role" value="{{\App\Enums\RoleEnum::Admin->value}}" {{ ($client->role->name === \App\Enums\RoleEnum::Admin->value) ? "checked" : "" }}>
                                <label for="admin" class="form-check-label">Amin</label><br>
                                <input id="secratary" type="radio" class="form-check-input @error('role') is-invalid @enderror" name="role" value="{{\App\Enums\RoleEnum::Secretary->value}}" {{ ($client->role->name === \App\Enums\RoleEnum::Secretary->value) ? "checked" : "" }}>
                                <label for="secratary" class="form-check-label">Secratary</label><br>
                                <input id="client" type="radio" class="form-check-input @error('role') is-invalid @enderror" name="role" value="{{\App\Enums\RoleEnum::Client->value}}" {{ ($client->role->name === \App\Enums\RoleEnum::Client->value) ? "checked" : "" }} >
                                <label for="client" class="form-check-label">Client</label><br>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit"></label>
                            <div class="col-md-8">
                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('home')}}" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection