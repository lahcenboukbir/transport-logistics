@extends('errors.app')

@section('title')
    <title>L'utilisateur n'a pas les permissions nécessaires</title>
@endsection

@section('error')
    <h1 class="display-5 coming-soon-text">403</h1>
    <p class="fs-14">L'utilisateur n'a pas les permissions nécessaires</p>
@endsection

@section('error-img')
    <img src="{{ asset('assets/images/maintenance.png') }}" alt="" class="img-fluid">
@endsection

