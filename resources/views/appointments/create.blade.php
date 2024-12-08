@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Rendez-vous</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('appointments.index') }}">Liste des rendez-vous</a>
                        </li>
                        <li class="breadcrumb-item active">Créer un rendez-vous</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session('error'))
        <div class="row">
            <div class="col">
                <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show material-shadow"
                    role="alert">
                    <i class="ri-notification-off-line label-icon"></i>
                    <strong>Error</strong> - {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <div>
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prospect_id" class="form-label">Prospect <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="prospect_id" class="form-select form-control-icon"
                                                aria-label="prospect_id">
                                                @foreach ($prospects as $prospect)
                                                    <option value="{{ $prospect->id }}">{{ $prospect->name }}</option>
                                                @endforeach

                                            </select>
                                            <i class="ri-user-add-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointment_date" class="form-label">Rendez-vous <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="datetime-local" name="appointment_date"
                                                class="form-control form-control-icon" id="appointment_date" required>
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-start">

                                        <a href="{{ route('appointments.index') }}"
                                            class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="ri-arrow-go-back-line label-icon align-middle fs-16 me-2"></i>
                                            Retour
                                        </a>

                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                            Ajouter
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
