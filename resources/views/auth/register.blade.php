{{-- @extends('layouts.app')

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
@endsection --}}

@php
    $site_name = DB::table('customizations')->where('name', 'site_name')->first();
@endphp

@extends('auth.app')

@section('content')
    <div>
        <h5 class="text-primary">Créer un compte</h5>
        <p class="text-muted">Obtenez votre compte {{$site_name->value}} gratuit dès maintenant.</p>
    </div>

    <div class="mt-4">
        <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter username">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Enter email address">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Mot de passe</label>
                <div class="position-relative auth-pass-inputgroup">
                    <input id="password" type="password"
                        class="form-control pe-5 password-input @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password" onpaste="return false" placeholder="Enter password"
                        aria-describedby="password">

                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="password-addon">
                        <i class="ri-eye-fill align-middle"></i>
                    </button>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password-confirm">Confirmer le mot de passe</label>
                <div class="position-relative auth-pass-inputgroup">
                    <input id="password-confirm" type="password" class="form-control pe-5 password-input"
                        name="password_confirmation" required autocomplete="new-password" onpaste="return false"
                        placeholder="Enter password" aria-describedby="confirm-password">

                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="password-addon">
                        <i class="ri-eye-fill align-middle"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">S'inscrire</button>
            </div>

        </form>
    </div>

    {{-- <div class="mt-5 text-center">
        <p class="mb-0">Vous avez déjà un compte ? <a href="{{ route('login') }}"
                class="fw-semibold text-primary text-decoration-underline"> Connectez-vous</a>
        </p>
    </div> --}}
@endsection
