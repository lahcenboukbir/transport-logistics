@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Utilisateurs</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Liste des utilisateurs</li>
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
        {{-- users --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Utilisateurs</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- users list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('users.list.excel') }}">liste_utilisateurs.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('users.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- prospects --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Prospects</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- prospects list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('prospects.list.excel') }}">liste_prospects.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('prospects.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- customers --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Clients</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- customers list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('customers.list.excel') }}">liste_clients.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('customers.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- appointments --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Clients</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- appointments list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('appointments.list.excel') }}">liste_rendez_vous.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('appointments.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- consultations --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Consultations</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- consultations list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('consultations.list.excel') }}">liste_consultations.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('consultations.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- shipments --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Expéditions</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- shipments list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('shipments.list.excel') }}">liste_expéditions.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('shipments.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ports --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Ports</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- ports list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('ports.list.excel') }}">liste_ports.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('ports.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- equipment --}}
        <div class="col-xxl-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1 mb-0">Equipements</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- equipment list --}}
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20 material-shadow">
                                                            <i class="ri-file-excel-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a
                                                                href="{{ route('equipments.list.excel') }}">liste_equipements.pdf</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a href="{{ route('equipments.list.excel') }}"
                                                        class="btn btn-success waves-effect waves-light"
                                                        title="Télécharger">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

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
