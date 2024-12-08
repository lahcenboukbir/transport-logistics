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
                            <a href="{{ route('consultations.index') }}">Liste des prospects</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $consultation->customer_name }}</li>
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
                    <h3 class="text-white mb-1">{{ $consultation->customer_name }}</h3>
                    <p class="text-white text-opacity-75">{{ $consultation->company }}</p>
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
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#shipments-tab" role="tab">
                                <i class="ri-calendar-2-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Expédition</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#equipments-tab" role="tab">
                                <i class="ri-calendar-2-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Equipements</span>
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
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    {{-- <tr>
                                                        <th class="ps-0" scope="row">Statut :</th>
                                                        <td class="text-muted">{{ $consultation->status }}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <th class="ps-0" scope="row">Remarques :</th>
                                                        <td class="text-muted">{{ $consultation->notes ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date de confirmation :</th>
                                                        <td class="text-muted">
                                                            {{ $consultation->confirmation_date ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date de consultation :</th>
                                                        <td class="text-muted">{{ $consultation->consultation_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Commercial :</th>
                                                        <td class="text-muted">
                                                            <a
                                                                href="{{ route('users.show', $consultation->user_id) }}">{{ $consultation->user_name }}</a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
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

                    <div class="tab-pane" id="shipments-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Port de départ :</th>
                                                        <td class="text-muted">{{ $shipment->departure_port }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Port d'arrivée :</th>
                                                        <td class="text-muted">{{ $shipment->arrival_port }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date de départ :</th>
                                                        <td class="text-muted">{{ $shipment->departure_date ?? 'N/A' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date d'arrivée :</th>
                                                        <td class="text-muted">{{ $shipment->arrival_date ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Durée :</th>
                                                        <td class="text-muted">{{ $shipment->duration ?? 'N/A' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
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

                    <div class="tab-pane" id="equipments-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Moyen :</th>
                                                        <td class="text-muted">
                                                            {{ $shipment->medium_name === 'maritime' ? 'Maritime' : ($shipment->medium_name === 'road' ? 'Routier' : ($shipment->medium_name === 'air' ? 'Aérien' : '')) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Quantité :</th>
                                                        <td class="text-muted">{{ $shipment->quantity ?? 'N/A' }}</td>
                                                    </tr>

                                                    @if ($shipment->medium_name === 'air')
                                                        <tr>
                                                            <th class="ps-0" scope="row">Volume :</th>
                                                            <td class="text-muted">{{ $equipment->volume }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Poids :</th>
                                                            <td class="text-muted">{{ $equipment->weight }}</td>
                                                        </tr>
                                                    @endif

                                                    @if ($shipment->medium_name === 'maritime')
                                                        <tr>
                                                            <th class="ps-0" scope="row">Type d'équipement :</th>
                                                            <td class="text-muted">{{ $equipment->equipment_name }}</td>
                                                        </tr>
                                                    @endif

                                                    @if ($shipment->medium_name === 'road')
                                                        <tr>
                                                            <th class="ps-0" scope="row">Type d'équipement :</th>
                                                            <td class="text-muted">{{ $equipment->equipment_name }}</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
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

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
