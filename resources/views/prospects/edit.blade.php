@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Prospects</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('prospects.index') }}">Liste des prospects</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $prospect->name }}</li>
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
                    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong> - {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <div>
                        <form action="{{ route('prospects.update', $prospect->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Contact <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="text" name="name" class="form-control form-control-icon"
                                                id="name" placeholder="Entrez le nom" value="{{ $prospect->name }}"
                                                required>
                                            <i class="ri-user-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Entreprise <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="text" name="company" class="form-control form-control-icon"
                                                id="company" placeholder="Entrez l'entreprise"
                                                value="{{ $prospect->company }}" required>
                                            <i class="ri-barcode-box-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ice" class="form-label">ICE</label>
                                        <div class="form-icon">
                                            <input type="text" name="ice" class="form-control form-control-icon"
                                                id="ice" placeholder="Entrez l'ICE" value="{{ $prospect->ice }}">
                                            <i class="ri-barcode-box-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="email" name="email" class="form-control form-control-icon"
                                                id="email" placeholder="Entrez l'e-mail" value="{{ $prospect->email }}"
                                                required>
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                        <div class="form-icon">
                                            <input type="text" name="phone_number" class="form-control form-control-icon"
                                                id="phone_number" placeholder="Entrez le numéro de téléphone"
                                                value="{{ $prospect->phone_number }}">
                                            <i class="ri-phone-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ville" class="form-label">Ville</label>
                                        <div class="form-icon">
                                            <input type="text" name="ville" class="form-control form-control-icon"
                                                id="ville" placeholder="Entrez la ville" value="{{ $prospect->city }}">
                                            <i class="ri-map-pin-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="activity" class="form-label">Activité</label>
                                        <div class="form-icon">
                                            <input type="text" name="activity" class="form-control form-control-icon"
                                                id="activity" placeholder="Entrez l'activité"
                                                value="{{ $prospect->activity }}">
                                            <i class="ri-briefcase-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Statut</label>
                                        <div class="form-icon">
                                            <select name="status" class="form-select form-control-icon"
                                                aria-label="status">
                                                <option value="new"
                                                    {{ $prospect->status === 'new' ? 'selected' : '' }}>Nouveau</option>
                                                <option value="interested"
                                                    {{ $prospect->status === 'interested' ? 'selected' : '' }}>Intéressé
                                                </option>
                                                <option value="not interested"
                                                    {{ $prospect->status === 'not interested' ? 'selected' : '' }}>Pas
                                                    intéressé</option>
                                                <option value="customer"
                                                    {{ $prospect->status === 'customer' ? 'selected' : '' }}>Client
                                                </option>
                                            </select>
                                            <i class="ri-user-smile-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Remarques</label>
                                        <div class="form-icon">
                                            <input type="text" name="notes" class="form-control form-control-icon"
                                                id="notes" placeholder="Entrez un remarque"
                                                value="{{ $prospect->notes }}">
                                            <i class="ri-chat-4-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-start">

                                        <a href="{{ route('prospects.index') }}"
                                            class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="ri-arrow-go-back-line label-icon align-middle fs-16 me-2"></i>
                                            Retour
                                        </a>

                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                            Modifier
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
