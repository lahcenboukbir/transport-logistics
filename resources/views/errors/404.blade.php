@extends('errors.app')

@section('title')
    <title>Page non trouvée</title>
@endsection

@section('error')
    <h1 class="display-5 coming-soon-text">404</h1>
    <p class="fs-14">Page non trouvée</p>
@endsection

@section('error-img')
    <img src="{{ asset('assets/images/maintenance.png') }}" alt="" class="img-fluid">
@endsection
