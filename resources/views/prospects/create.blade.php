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
                        <li class="breadcrumb-item active">Créer un prospect</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <div>
                        <form action="{{ route('prospects.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Contact <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="text" name="name" class="form-control form-control-icon"
                                                id="name" placeholder="Entrez le nom" required>
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
                                                id="company" placeholder="Entrez l'entreprise" required>
                                            <i class="ri-building-4-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ice" class="form-label">ICE</label>
                                        <div class="form-icon">
                                            <input type="text" name="ice" class="form-control form-control-icon"
                                                id="ice" placeholder="Entrez l'ICE">
                                            <i class="ri-barcode-box-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span>
                                        </label>
                                        <div class="form-icon">
                                            <input type="email" name="email" class="form-control form-control-icon"
                                                id="email" placeholder="Entrez l'e-mail" required>
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                        <div class="form-icon">
                                            <input type="text" name="phone_number" class="form-control form-control-icon"
                                                id="phone_number" placeholder="Entrez le numéro de téléphone">
                                            <i class="ri-phone-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Ville</label>
                                        <div class="form-icon">
                                            <input type="text" name="city" class="form-control form-control-icon"
                                                id="city" placeholder="Entrez la ville">
                                            <i class="ri-map-pin-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="activity" class="form-label">Activité</label>
                                        <div class="form-icon">
                                            <input type="text" name="activity" class="form-control form-control-icon"
                                                id="activity" placeholder="Entrez l'activité">
                                            <i class="ri-briefcase-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Statut</label>
                                        <div class="form-icon">
                                            <select name="status" class="form-select form-control-icon" aria-label="status">
                                                <option disabled>Sélectionnez un statut</option>
                                                <option value="new" selected>Nouveau</option>
                                                <option value="interested">Intéressé</option>
                                                <option value="not interested">Pas intéressé</option>
                                                <option value="customer">Client</option>
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
                                                id="notes" placeholder="Entrez un remarque">
                                            <i class="ri-chat-4-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointment_date" class="form-label">Rendez-vous <span
                                            class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="datetime-local" name="appointment_date" class="form-control form-control-icon"
                                                id="appointment_date" required>
                                                <i class="ri-calendar-2-line"></i>
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
