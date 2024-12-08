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
                            <a href="{{ route('roles.index') }}">Liste des roles</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $role->name }}</li>
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
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <div>
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom du rôle <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="text" name="name" class="form-control form-control-icon"
                                                id="name" placeholder="Entrez le nom du rôle" required
                                                value="{{ $role->name }}">
                                            <i class="ri-user-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $user->id }}"
                                                                        value="{{ $user->name }}"
                                                                        {{ in_array($user->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $user->id }}">{{ $user->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $prospect->id }}"
                                                                        value="{{ $prospect->name }}"
                                                                        {{ in_array($prospect->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $prospect->id }}">{{ $prospect->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $customer->id }}"
                                                                        value="{{ $customer->name }}"
                                                                        {{ in_array($customer->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $customer->id }}">{{ $customer->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $appointment->id }}"
                                                                        value="{{ $appointment->name }}"
                                                                        {{ in_array($appointment->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $appointment->id }}">{{ $appointment->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $consultation->id }}"
                                                                        value="{{ $consultation->name }}"
                                                                        {{ in_array($consultation->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $consultation->id }}">{{ $consultation->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $port->id }}"
                                                                        value="{{ $port->name }}"
                                                                        {{ in_array($port->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $port->id }}">{{ $port->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $shipment->id }}"
                                                                        value="{{ $shipment->name }}"
                                                                        {{ in_array($shipment->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $shipment->id }}">{{ $shipment->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $equipment->id }}"
                                                                        value="{{ $equipment->name }}"
                                                                        {{ in_array($equipment->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $equipment->id }}">{{ $equipment->name }}</label>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- customization --}}
                                                <tr class="align-middle">
                                                    <th class="table-light text-center">Personnalisation</th>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            @foreach ($customization_permissions as $customization)
                                                                <div>
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $customization->id }}"
                                                                        value="{{ $customization->name }}"
                                                                        {{ in_array($customization->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $customization->id }}">{{ $customization->name }}</label>
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
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $report->id }}"
                                                                        value="{{ $report->name }}"
                                                                        {{ in_array($report->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $report->id }}">{{ $report->name }}</label>
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
                                                            @foreach ($role_permissions as $permission)
                                                                <div>
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="btn-check"
                                                                        id="permission_{{ $permission->id }}"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->name, $assigned_permissions) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="btn btn-outline-primary material-shadow m-0"
                                                                        for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-start">

                                        <a href="{{ route('roles.index') }}"
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
