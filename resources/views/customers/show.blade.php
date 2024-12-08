@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Clients</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('customers.index') }}">Liste des clients</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $customer->name }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4 align-items-center">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ asset('assets/images/users/user-dummy-img.jpg') }}" alt="user-img"
                        class="img-thumbnail rounded-circle" />
                </div>
            </div>

            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $customer->name }}</h3>
                    <p class="text-white text-opacity-75">{{ $customer->company }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex profile-wrapper">

                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-information-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Aperçu</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#appointments-tab" role="tab">
                                <i class="ri-calendar-2-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Rendez-vous</span>
                            </a>
                        </li>
                    </ul>

                </div>

                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Informations</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Nom :</th>
                                                        <td class="text-muted">{{ $customer->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Entreprise :</th>
                                                        <td class="text-muted">{{ $customer->company }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">ICE :</th>
                                                        <td class="text-muted">{{ $customer->ice ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Email :</th>
                                                        <td class="text-muted">{{ $customer->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Numéro de téléphone :</th>
                                                        <td class="text-muted">{{ $customer->phone_number ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Ville :</th>
                                                        <td class="text-muted">{{ $customer->city ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Activité :</th>
                                                        <td class="text-muted">{{ $customer->activity ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Remarques :</th>
                                                        <td class="text-muted">{{ $customer->notes ?? 'N/A' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Créé par :</th>
                                                        <td class="text-muted">
                                                            <a
                                                                href="{{ route('users.show', $created_by->id ?? '#') }}">{{ $created_by->name ?? 'N/A' }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date d'entrée</th>
                                                        <td class="text-muted">{{ $customer->created_at ?? 'N/A' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Contact</h5>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div>
                                                <a href="mailto:{{ $customer->email }}" class="avatar-xs d-block"
                                                    title="Email">
                                                    <span
                                                        class="avatar-title rounded-circle fs-16 bg-primary material-shadow">
                                                        <i class="ri-mail-line"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="tel:{{ $customer->phone_number }}" class="avatar-xs d-block"
                                                    title="Numéro de téléphone">
                                                    <span
                                                        class="avatar-title rounded-circle fs-16 bg-primary material-shadow">
                                                        <i class="ri-phone-line"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a href="{{ url()->previous() }}"
                                            class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="ri-arrow-go-back-line label-icon align-middle fs-16 me-2"></i>
                                            Retour
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="appointments-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Utilisateurs</th>
                                            <th>Date du rendez-vous</th>
                                            <th>Résultat</th>
                                            <th>Durée</th>
                                            <th>Remarques</th>
                                            <th>Lieu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($appointments as $appointment)
                                            <tr class="align-middle">
                                                <th>{{ $appointment->id }}</th>
                                                <td>{{ $appointment->user_name }}</td>
                                                <td>{{ $appointment->appointment_date }}</td>
                                                <td>{{ $appointment->outcome ?? 'N/A' }}</td>
                                                <td>{{ $appointment->duration ?? 'N/A' }}</td>
                                                <td>{{ $appointment->notes ?? 'N/A' }}</td>
                                                <td>{{ $appointment->location ?? 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Il n'y a aucun rendez-vous ajouté
                                                    par
                                                    {{ $appointment->user_name ?? 'N/A' }}.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
