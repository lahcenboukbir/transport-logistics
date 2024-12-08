@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Ports</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('equipments.index') }}">Liste des ports</a>
                        </li>
                        <li class="breadcrumb-item active">Créer un port</li>
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
                        <form action="{{ route('equipments.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="equipment_name" class="form-label">Nom de l'équipement <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="text" name="equipment_name"
                                                class="form-control form-control-icon" id="equipment_name"
                                                placeholder="Entrez le nom de l'équipement" required>
                                            <i class="ri-ship-2-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="type" class="form-select form-control-icon" aria-label="type">
                                                <option selected disabled>Sélectionnez un type</option>
                                                <option value="road">Routier</option>
                                                <option value="maritime">Maritime</option>
                                            </select>
                                            <i class="ri-list-check"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <div class="form-icon">
                                            <input type="text" name="description" class="form-control form-control-icon"
                                                id="description" placeholder="Entrez la description">
                                            <i class="ri-align-left"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-start">

                                        <a href="{{ route('equipments.index') }}"
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
