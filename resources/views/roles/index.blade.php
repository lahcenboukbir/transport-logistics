@extends('layouts.app')

@section('link')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Gestion des rôles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Liste des roles</li>
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
                @can('create roles')
                    <div class="card-header">
                        <div>
                            <a href="{{ route('roles.create') }}" class="btn btn-success btn-label waves-effect waves-light">
                                <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                @endcan

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du rôle</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            @can('view roles')
                                                {{-- show --}}
                                                <a href="{{ route('roles.show', $role->id) }}" type="button"
                                                    class="btn btn-primary waves-effect waves-light" title="Afficher">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            @endcan

                                            @if (!$loop->first)
                                                @can('edit roles')
                                                    {{-- edit --}}
                                                    <a href="{{ route('roles.edit', $role->id) }}" type="button"
                                                        class="btn btn-warning waves-effect waves-light" title="Modifier">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                @endcan

                                                @can('delete roles')
                                                    {{-- delete --}}
                                                    <button class="btn btn-danger waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal{{ $role->id }}"
                                                        title="Supprimer">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>

                                                    {{-- delete modal --}}
                                                    <div class="modal fade zoomIn" id="deleteRecordModal{{ $role->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"
                                                                        id="btn-close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                                            trigger="loop"
                                                                            colors="primary:#f7b84b,secondary:#f06548"
                                                                            style="width:100px;height:100px">
                                                                        </lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Êtes-vous sûr ? </h4>
                                                                            <p class="text-muted mx-4 mb-0">Êtes-vous sûr de
                                                                                vouloir
                                                                                supprimer ceci ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')

                                                                            <button type="button" class="btn w-sm btn-light"
                                                                                data-bs-dismiss="modal">Fermer
                                                                            </button>

                                                                            <button type="submit" class="btn w-sm btn-danger "
                                                                                id="delete-record">Oui, supprimez-le !
                                                                            </button>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
