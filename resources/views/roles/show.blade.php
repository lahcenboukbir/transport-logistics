@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Gestion des rôles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}">Liste des rôles</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $role->name }}</li>
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
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1 text-uppercase">{{ $role->name }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>

                <div class="tab-content pt-4 text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Rôles assignés</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered rounded-3">
                                            <tbody>
                                                {{-- users --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Utilisateurs</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($user_permissions as $user)
                                                                <div>
                                                                    @if (in_array($user, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $user }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- prospects --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Prospects</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($prospect_permissions as $prospect)
                                                                <div>
                                                                    @if (in_array($prospect, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $prospect }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- customers --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Clients</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($customer_permissions as $customer)
                                                                <div>
                                                                    @if (in_array($customer, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $customer }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- appointments --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Rendez-vous</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($appointment_permissions as $appointment)
                                                                <div>
                                                                    @if (in_array($appointment, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $appointment }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- consultations --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Consultations</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($consultation_permissions as $consultation)
                                                                <div>
                                                                    @if (in_array($consultation, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $consultation }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- ports --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Ports</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($port_permissions as $port)
                                                                <div>
                                                                    @if (in_array($port, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $port }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- shipments --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Expéditions</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($shipment_permissions as $shipment)
                                                                <div>
                                                                    @if (in_array($shipment, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $shipment }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- equipments --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Equipements</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($equipment_permissions as $equipment)
                                                                <div>
                                                                    @if (in_array($equipment, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $equipment }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- customizations --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Personnalisation</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($customization_permissions as $customization)
                                                                <div>
                                                                    @if (in_array($customization, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $customization }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- reports --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Rapport</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($report_permissions as $report)
                                                                <div>
                                                                    @if (in_array($report, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $report }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- roles --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Rôles</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($role_permissions as $permissions)
                                                                <div>
                                                                    @if (in_array($permissions, $assigned_permissions))
                                                                        <input type="checkbox" class="btn-check" checked>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0">{{ $permissions }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
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
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
