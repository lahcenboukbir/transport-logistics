@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
@endsection

@section('content')
    {{-- overview --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-body p-0">
                    <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-1 g-0">

                        {{-- users --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    utilisateurs
                                    <a href="{{ route('users.index') }}" title="Voir plus">
                                        <i class="ri-external-link-line text-primary fs-18 float-end align-middle"></i>
                                    </a>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-user-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $total_users }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- prospects --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    prospects
                                    <a href="{{ route('prospects.index') }}" title="Voir plus">
                                        <i class="ri-external-link-line text-primary fs-18 float-end align-middle"></i>
                                    </a>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-user-add-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $total_prospects }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- customers --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    Clients
                                    <a href="{{ route('customers.index') }}" title="Voir plus">
                                        <i class="ri-external-link-line text-primary fs-18 float-end align-middle"></i>
                                    </a>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-user-follow-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $total_customers }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- conversion rate --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    Taux de conversion
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-percent-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value"
                                                data-target="{{ round($conversion_rate, 2) }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-body p-0">
                    <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-1 g-0">

                        {{-- upcoming appointments --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    Prochains rendez-vous
                                    <a href="{{ route('appointments.index') }}" title="Voir plus">
                                        <i class="ri-external-link-line text-primary fs-18 float-end align-middle"></i>
                                    </a>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-calendar-2-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $upcoming_appointments }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- active shipments --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    Expéditions actives
                                    <a href="{{ route('shipments.index') }}" title="Voir plus">
                                        <i class="ri-external-link-line text-primary fs-18 float-end align-middle"></i>
                                    </a>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-box-3-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $active_shipments }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- canceled shipments --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    Équipements
                                    <a href="{{ route('equipments.index') }}" title="Voir plus">
                                        <i class="ri-external-link-line text-primary fs-18 float-end align-middle"></i>
                                    </a>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-box-3-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $total_equipments }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Revenue --}}
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    Revenu
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-money-dollar-circle-line display-6 text-muted cfs-22"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0 cfs-22">
                                            <span class="counter-value" data-target="{{ $revenue }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- charts --}}
    <div class="row">
        {{-- prospects --}}
        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Prospects</h4>
                </div>

                <div class="card-body">
                    <div id="prospects_charts" class="apex-charts" dir="ltr"></div>

                    <div class="table-responsive mt-3">
                        <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                            <tbody class="border-0">
                                {{-- new --}}
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0">
                                            <i class="ri-stop-fill align-middle fs-18 text-primary me-2"></i>Nouveaux
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-text-muted fw-medium fs-12 mb-0">
                                            {{ round($new_prospects_rate, 2) }}%</p>
                                    </td>
                                </tr>

                                {{-- interested --}}
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0">
                                            <i class="ri-stop-fill align-middle fs-18 text-success me-2"></i>Intéressés
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-text-muted fw-medium fs-12 mb-0">
                                            {{ round($interested_prospects_rate, 2) }}%
                                        </p>
                                    </td>
                                </tr>

                                {{-- not interested --}}
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0">
                                            <i class="ri-stop-fill align-middle fs-18 text-danger me-2"></i>Non intéressés
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-text-muted fw-medium fs-12 mb-0">
                                            {{ round($not_interested_prospects_rate, 2) }}%</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- appointments --}}
        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Rendez-vous</h4>
                </div>

                <div class="card-body">
                    <div id="appointments_charts" dir="ltr"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- new --}}
    <div class="row">
        {{-- new prospects --}}
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Nouveaux utilisateurs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Commercial</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($new_prospects_list as $new_prospect)
                                    <tr>
                                        <td>
                                            <a href="{{ route('prospects.show', $new_prospect->id) }}"
                                                class="text-body">{{ $new_prospect->name }}</a>
                                        </td>
                                        <td>{{ $new_prospect->company }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $new_prospect->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $new_prospect->user_id) }}"
                                                class="text-body fw-medium">{{ $new_prospect->user_name }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Il n'y a aucun nouveau prospect</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- new prospects --}}
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Nouveaux prospects</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Commercial</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($new_prospects_list as $new_prospect)
                                    <tr>
                                        <td>
                                            <a href="{{ route('prospects.show', $new_prospect->id) }}"
                                                class="text-body">{{ $new_prospect->name }}</a>
                                        </td>
                                        <td>{{ $new_prospect->company }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $new_prospect->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $new_prospect->user_id) }}"
                                                class="text-body fw-medium">{{ $new_prospect->user_name }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Il n'y a aucun nouveau prospect</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- new customers --}}
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Nouveaux clients</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Commercial</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($new_customers_list as $new_customer)
                                    <tr>
                                        <td>
                                            <a href="{{ route('customers.show', $new_customer->id) }}"
                                                class="text-body">{{ $new_customer->name }}</a>
                                        </td>
                                        <td>{{ $new_customer->company }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $new_customer->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $new_customer->user_id) }}"
                                                class="text-body fw-medium">{{ $new_customer->user_name }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Il n'y a aucun nouveau client</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- appointments --}}
    <div class="row">
        {{-- today appointments --}}
        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Rendez-vous aujourd'hui</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Numéro de téléphone</th>
                                    <th scope="col">Commercial</th>
                                    <th scope="col">Prochains rendez-vous</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($today_appointments as $today_appointment)
                                    <tr>
                                        <td>
                                            <a href="{{ route('prospects.show', $today_appointment->id) }}"
                                                class="text-body">{{ $today_appointment->name }}</a>
                                        </td>
                                        <td>{{ $today_appointment->company }}</td>
                                        <td>{{ $today_appointment->phone_number ?? 'N/A' }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $today_appointment->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $today_appointment->user_id) }}"
                                                class="text-body fw-medium">{{ $today_appointment->user_name }}
                                            </a>
                                        </td>
                                        <td>{{ $today_appointment->appointment_date }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Il n'y a aucun rendez-vous aujourd'hui</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- tomorrow appointments --}}
        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Rendez-vous de demain</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Numéro de téléphone</th>
                                    <th scope="col">Commercial</th>
                                    <th scope="col">Prochains rendez-vous</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($tomorrow_appointments as $tomorrow_appointment)
                                    <tr>
                                        <td>
                                            <a href="{{ route('prospects.show', $tomorrow_appointment->id) }}"
                                                class="text-body">{{ $tomorrow_appointment->name }}</a>
                                        </td>
                                        <td>{{ $tomorrow_appointment->company }}</td>
                                        <td>{{ $tomorrow_appointment->phone_number ?? 'N/A' }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $tomorrow_appointment->img) }}"
                                                alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $tomorrow_appointment->user_id) }}"
                                                class="text-body fw-medium">{{ $tomorrow_appointment->user_name }}
                                            </a>
                                        </td>
                                        <td>{{ $tomorrow_appointment->appointment_date }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Il n'y a aucun rendez-vous prévu pour
                                            demain</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- shipments --}}
    <div class="row">
        {{-- pending --}}
        <div class="col-xl-3">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Expéditions en attente</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    {{-- <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th> --}}
                                    <th scope="col">Départ</th>
                                    <th scope="col">Arrivée</th>
                                    <th scope="col">Moyen</th>
                                    {{-- <th scope="col">Commercial</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pending_shipments as $pending_shipment)
                                    <tr>
                                        {{-- <td>
                                            <a href="{{ route('customers.show', $pending_shipment->customer_id) }}"
                                                class="text-body">{{ $pending_shipment->customer_name }}</a>
                                        </td>
                                        <td>{{ $pending_shipment->company }}</td> --}}
                                        <td>{{ $pending_shipment->departure_port . ' (' . $pending_shipment->departure_date . ')' }}
                                        </td>
                                        <td>{{ $pending_shipment->arrival_port . ' (' . $pending_shipment->arrival_date . ')' }}
                                        </td>
                                        <td>{{ $pending_shipment->medium_name }}</td>
                                        {{-- <td>
                                            <img src="{{ asset('storage/' . $pending_shipment->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $pending_shipment->user_id) }}"
                                                class="text-body fw-medium">{{ $pending_shipment->user_name }}
                                            </a>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Il n'y a pas d'expéditions en attente</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- in transit --}}
        <div class="col-xl-3">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Expéditions en transit</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    {{-- <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th> --}}
                                    <th scope="col">Départ</th>
                                    <th scope="col">Arrivée</th>
                                    <th scope="col">Moyen</th>
                                    {{-- <th scope="col">Commercial</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($in_transit_shipments as $in_transit_shipment)
                                    <tr>
                                        {{-- <td>
                                            <a href="{{ route('customers.show', $in_transit_shipment->customer_id) }}"
                                                class="text-body">{{ $in_transit_shipment->customer_name }}</a>
                                        </td>
                                        <td>{{ $in_transit_shipment->company }}</td> --}}
                                        <td>{{ $in_transit_shipment->departure_port . ' (' . $in_transit_shipment->departure_date . ')' }}
                                        </td>
                                        <td>{{ $in_transit_shipment->arrival_port . ' (' . $in_transit_shipment->arrival_date . ')' }}
                                        </td>
                                        <td>{{ $in_transit_shipment->medium_name }}</td>
                                        {{-- <td>
                                            <img src="{{ asset('storage/' . $in_transit_shipment->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $in_transit_shipment->user_id) }}"
                                                class="text-body fw-medium">{{ $in_transit_shipment->user_name }}
                                            </a>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Il n'y a pas d'expéditions en transit</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- delivered --}}
        <div class="col-xl-3">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Expéditions livrées</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    {{-- <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th> --}}
                                    <th scope="col">Départ</th>
                                    <th scope="col">Arrivée</th>
                                    <th scope="col">Moyen</th>
                                    {{-- <th scope="col">Commercial</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($delivered_shipments as $delivered_shipment)
                                    <tr>
                                        {{-- <td>
                                            <a href="{{ route('customers.show', $delivered_shipment->customer_id) }}"
                                                class="text-body">{{ $delivered_shipment->customer_name }}</a>
                                        </td>
                                        <td>{{ $delivered_shipment->company }}</td> --}}
                                        <td>{{ $delivered_shipment->departure_port . ' (' . $delivered_shipment->departure_date . ')' }}
                                        </td>
                                        <td>{{ $delivered_shipment->arrival_port . ' (' . $delivered_shipment->arrival_date . ')' }}
                                        </td>
                                        <td>{{ $delivered_shipment->medium_name }}</td>
                                        {{-- <td>
                                            <img src="{{ asset('storage/' . $delivered_shipment->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $delivered_shipment->user_id) }}"
                                                class="text-body fw-medium">{{ $delivered_shipment->user_name }}
                                            </a>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Il n'y a pas d'expéditions livrées</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- canceled --}}
        <div class="col-xl-3">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Expéditions annulées</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light">

                                <tr class="text-muted">
                                    {{-- <th scope="col">Nom</th>
                                    <th scope="col">Entreprise</th> --}}
                                    <th scope="col">Départ</th>
                                    <th scope="col">Arrivée</th>
                                    <th scope="col">Moyen</th>
                                    {{-- <th scope="col">Commercial</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($canceled_shipments as $canceled_shipment)
                                    <tr>
                                        {{-- <td>
                                            <a href="{{ route('customers.show', $canceled_shipment->customer_id) }}"
                                                class="text-body">{{ $canceled_shipment->customer_name }}</a>
                                        </td>
                                        <td>{{ $canceled_shipment->company }}</td> --}}
                                        <td>{{ $canceled_shipment->departure_port . ' (' . $canceled_shipment->departure_date . ')' }}
                                        </td>
                                        <td>{{ $canceled_shipment->arrival_port . ' (' . $canceled_shipment->arrival_date . ')' }}
                                        </td>
                                        <td>{{ $canceled_shipment->medium_name }}</td>
                                        {{-- <td>
                                            <img src="{{ asset('storage/' . $canceled_shipment->img) }}" alt=""
                                                class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="{{ route('users.show', $canceled_shipment->user_id) }}"
                                                class="text-body fw-medium">{{ $canceled_shipment->user_name }}
                                            </a>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Il n'y a pas d'expéditions annulées</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- equipments --}}
    <div class="row">
        {{-- equipment distribution --}}
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Utilisation des équipements</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <tr>
                                <th>Maritime</th>
                                <td>
                                    <span class="badge bg-primary px-2 py-2">{{ $maritime_equipment_distribution }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Routier</th>
                                <td>
                                    <span class="badge bg-primary px-2 py-2">{{ $road_equipment_distribution }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- average --}}
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Moyenne</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <tr>
                                <th>Volume</th>
                                <td>
                                    <span class="badge bg-primary px-2 py-2">{{ $volume_average }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Poids</th>
                                <td>
                                    <span class="badge bg-primary px-2 py-2">{{ $weight_average }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- most used --}}
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Équipement le plus utilisé</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                            <tr>
                                <th>Maritime</th>
                                <td>
                                    @forelse ($most_maritime_equipments as $maritime_equipment)
                                        <span
                                            class="badge bg-primary px-2 py-2">{{ $maritime_equipment->equipment_name }}</span>
                                    @empty
                                        <span class="badge bg-primary px-2 py-2">aucun</span>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Routier</th>
                                <td>
                                    @forelse ($most_road_equipments as $road_equipment)
                                        <span
                                            class="badge bg-primary px-2 py-2">{{ $road_equipment->equipment_name }}</span>
                                    @empty
                                        <span class="badge bg-primary px-2 py-2">aucun</span>
                                    @endforelse
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard-analytics.init.js') }}"></script>
    <!-- Dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard-crm.init.js') }}"></script>

    <script>

        // prospects - pie chart
        var options = {
            series: [{{ $new_prospects }}, {{ $interested_prospects }}, {{ $not_interested_prospects }}],
            labels: ["Nouveaux", "Intéressés", "Non intéressés"],
            chart: {
                type: "donut",
                height: 219
            },
            plotOptions: {
                pie: {
                    size: 100,
                    donut: {
                        size: "76%"
                    }
                }
            },
            dataLabels: {
                enabled: !1
            },
            legend: {
                show: !1,
                position: "bottom",
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: 0,
                markers: {
                    width: 20,
                    height: 6,
                    radius: 2
                },
                itemMargin: {
                    horizontal: 12,
                    vertical: 0
                },
            },
            stroke: {
                width: 0
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return e + ' prospects';
                    },
                },
                tickAmount: 4,
                min: 0,
            },
            colors: ["#405189", "#02a8b5", "#f06548"],
        };

        var chart = new ApexCharts(document.querySelector("#prospects_charts"), options);
        chart.render();

        // appointments - radial chart
        var options2 = {
            series: [{{ $successful_appointments }}, {{ $failed_appointments }}, {{ $pending_appointments }}],
            chart: {
                height: 350,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: "22px"
                        },
                        value: {
                            fontSize: "16px"
                        },
                        total: {
                            show: !0,
                            label: "Total",
                            formatter: function() {
                                return {{ $successful_appointments }} + {{ $failed_appointments }} +
                                    {{ $pending_appointments }};
                            },
                        },
                    },
                },
            },
            labels: ["Succès", "Échec", "En attente"],
            colors: ["#02a8b5", "#f06548", "#405189"],
        };

        var chart2 = new ApexCharts(document.querySelector("#appointments_charts"), options2);
        chart2.render();
    </script>
@endsection
