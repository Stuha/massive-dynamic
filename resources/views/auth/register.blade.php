@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3 " >
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contacts[]" value="" autocomplete="contact" autofocus>
                                <input id="phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumbers[]" value="" placeholder="Add contact number"  autocomplete="name" autofocus>

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 " >
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Contact1') }}</label>

                            <div class="col-md-6">
                                <input id="contact1" type="text" class="form-control @error('contact') is-invalid @enderror" name="contacts[]" value=""  autocomplete="contact" autofocus>
                                <input id="phoneNumber1" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumbers[]" value="" placeholder="Add contact number"  autocomplete="name" autofocus>

                                @error('contact1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 " >
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Contact2') }}</label>

                            <div class="col-md-6">
                                <input id="contact2" type="text" class="form-control @error('contact2') is-invalid @enderror" name="contacts[]" value=""  autocomplete="contact" autofocus>
                                <input id="phoneNumber2" type="text" class="form-control @error('phoneNumber2') is-invalid @enderror" name="phoneNumbers[]" value="" placeholder="Add contact number"  autocomplete="name" autofocus>

                                @error('contact2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <input id="admin" type="radio" class="form-check-input @error('role') is-invalid @enderror" name="role" value="{{\App\Enums\RoleEnum::Admin->value}}">
                                <label for="admin" class="form-check-label">Amin</label><br>
                                <input id="secratary" type="radio" class="form-check-input @error('role') is-invalid @enderror" name="role" value="{{\App\Enums\RoleEnum::Secretary->value}}">
                                <label for="secratary" class="form-check-label">Secratary</label><br>
                                <input id="client" type="radio" class="form-check-input @error('role') is-invalid @enderror" name="role" value="{{\App\Enums\RoleEnum::Client->value}}">
                                <label for="client" class="form-check-label">Client</label><br>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection