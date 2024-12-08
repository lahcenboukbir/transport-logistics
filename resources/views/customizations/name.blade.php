@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Personnalisation</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Nom</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="row">
            <div class="col">
                <div class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade show material-shadow"
                    role="alert">
                    <i class="ri-notification-off-line label-icon"></i>
                    <strong>Success</strong> - {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="row g-0">
                    <div
                        class="col-md-12 col-xxl-4 bg-primary p-3 rounded-start d-flex justify-content-center align-items-center">
                        <h1 class="text-white">{{ $site_name->value }}</h1>
                    </div>
                    <div class="col-md-12 col-xxl-8">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0">Nom</h5>
                        </div>
                        @can('edit name customizations')
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('name.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input class="form-control" type="text" name="value"
                                            value="{{ $site_name->value }}" placeholder="Entrez le nom">
                                        <button type="submit" class="btn btn-primary mt-3">Changer</button>
                                    </form>
                                </div>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
