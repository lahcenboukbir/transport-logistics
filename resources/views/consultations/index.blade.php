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
                <h4 class="mb-sm-0">Consultaions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Liste des consultations</li>
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
                @can('create consultations')
                    <div class="card-header">
                        <div>
                            <a href="{{ route('consultations.create') }}"
                                class="btn btn-success btn-label waves-effect waves-light">
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
                                <th data-ordering="false">ID</th>
                                <th>Contact</th>
                                <th>Commercial</th>
                                <th>Remarques</th>
                                <th>Date de confirmation</th>
                                <th>Date de consultation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $consultation)
                                <tr>
                                    <td>{{ $consultation->id }}</td>
                                    <td>{{ $consultation->name }}</td>
                                    <td>{{ $consultation->user_name }}</td>
                                    <td>{{ $consultation->notes ?? 'N/A' }}</td>
                                    <td>{{ $consultation->confirmation_date ?? 'N/A' }}</td>
                                    <td>{{ $consultation->consultation_date }}</td>

                                    <td>
                                        <div class="dropdown d-inline-block">
                                            @can('view consultations')
                                                {{-- show --}}
                                                <a href="{{ route('consultations.show', $consultation->id) }}" type="button"
                                                    class="btn btn-primary waves-effect waves-light" title="Afficher">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            @endcan

                                            @can('edit consultations')
                                                {{-- edit --}}
                                                <a href="{{ route('consultations.edit', $consultation->id) }}" type="button"
                                                    class="btn btn-warning waves-effect waves-light" title="Modifier">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            @endcan

                                            @can('delete consultations')
                                                {{-- delete --}}
                                                <button class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal{{ $consultation->id }}"
                                                    title="Supprimer">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>

                                                {{-- delete modal --}}
                                                <div class="modal fade zoomIn" id="deleteRecordModal{{ $consultation->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close" id="btn-close"></button>
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
                                                                    <form
                                                                        action="{{ route('consultations.destroy', $consultation->id) }}"
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

                                            @can('manage confirmation consultations')
                                                {{-- confirm --}}
                                                @if (!$consultation->confirmation_date)
                                                    <button class="btn btn-success waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmRecordModal{{ $consultation->id }}"
                                                        title="Confirmer">
                                                        <i class="ri-checkbox-circle-line"></i>
                                                    </button>

                                                    <div class="modal fade zoomIn"
                                                        id="confirmRecordModal{{ $consultation->id }}" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"
                                                                        id="btn-close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/hmzvkifi.json"
                                                                            trigger="loop" style="width:100px;height:100px">
                                                                        </lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Êtes-vous sûr ? </h4>
                                                                            <p class="text-muted mx-4 mb-0">Êtes-vous sûr de
                                                                                vouloir confirmer <br> cette consultation ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <form
                                                                            action="{{ route('consultations.confirm', $consultation->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <button type="button" class="btn w-sm btn-light"
                                                                                data-bs-dismiss="modal">Fermer
                                                                            </button>

                                                                            <button type="submit"
                                                                                class="btn w-sm btn-success "
                                                                                id="delete-record">Oui, confirmez-le !
                                                                            </button>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- unconfirm --}}
                                                @if ($consultation->confirmation_date)
                                                    <button class="btn btn-secondary waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#unconfirmRecordModal{{ $consultation->id }}"
                                                        title="Déconfirmer">
                                                        <i class="ri-refresh-line"></i>
                                                    </button>

                                                    <div class="modal fade zoomIn"
                                                        id="unconfirmRecordModal{{ $consultation->id }}" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"
                                                                        id="btn-close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/jxhgzthg.json"
                                                                            trigger="loop" style="width:100px;height:100px">
                                                                        </lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Êtes-vous sûr ? </h4>
                                                                            <p class="text-muted mx-4 mb-0">Êtes-vous sûr de
                                                                                vouloir annuler la<br> confirmation de cette
                                                                                consultation ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <form
                                                                            action="{{ route('consultations.unconfirm', $consultation->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <button type="button" class="btn w-sm btn-light"
                                                                                data-bs-dismiss="modal">Fermer
                                                                            </button>

                                                                            <button type="submit"
                                                                                class="btn w-sm btn-secondary "
                                                                                id="delete-record">Oui, annulez-le !
                                                                            </button>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- notes --}}
                                                @if ($consultation->confirmation_date)
                                                    <button class="btn btn-info waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#notesRecordModal{{ $consultation->id }}"
                                                        title="Remarques">
                                                        <i class="ri-message-line"></i>
                                                    </button>

                                                    <div id="notesRecordModal{{ $consultation->id }}" class="modal zoomIn"
                                                        tabindex="-1" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-0 overflow-hidden">
                                                                <div class="modal-header p-3">
                                                                    <h4 class="card-title mb-0">Ajouter des remarques</h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('consultations.notes', $consultation->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="mb-3">
                                                                            <label for="notes"
                                                                                class="form-label">Remarques</label>
                                                                            <input type="text" name="notes"
                                                                                class="form-control" id="notes"
                                                                                placeholder="Entrez les remarques"
                                                                                value="{{ $consultation->notes }}">
                                                                        </div>

                                                                        <div
                                                                            class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                            <button type="button" class="btn w-sm btn-light"
                                                                                data-bs-dismiss="modal">Fermer
                                                                            </button>

                                                                            @if ($consultation->notes)
                                                                                <button type="submit" class="btn btn-info">
                                                                                    Modifier
                                                                                </button>
                                                                            @else
                                                                                <button type="submit" class="btn btn-info">
                                                                                    Ajouter
                                                                                </button>
                                                                            @endif

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- concretisation --}}
                                                @if ($consultation->confirmation_date)
                                                    <button class="btn btn-dark waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#concretisationRecordModal{{ $consultation->id }}"
                                                        title="Concretisation">
                                                        <i class="ri-money-dollar-circle-line"></i>
                                                    </button>

                                                    <div id="concretisationRecordModal{{ $consultation->id }}"
                                                        class="modal zoomIn" tabindex="-1" aria-hidden="true"
                                                        style="display: none;">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-0 overflow-hidden">
                                                                <div class="modal-header p-3">
                                                                    <h4 class="card-title mb-0">Informations de Tarification
                                                                    </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('consultations.concretisation', $consultation->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="mb-3">
                                                                            <label for="selling_price" class="form-label">Prix
                                                                                de
                                                                                vente</label>
                                                                            <input type="text" name="selling_price"
                                                                                class="form-control" id="selling_price"
                                                                                placeholder="Entrez le prix de vente"
                                                                                value="{{ $consultation->selling_price }}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="buying_price" class="form-label">Prix
                                                                                d'achat</label>
                                                                            <input type="text" name="buying_price"
                                                                                class="form-control" id="buying_price"
                                                                                placeholder="Entrez le prix d'achat"
                                                                                value="{{ $consultation->buying_price }}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="agent_commission"
                                                                                class="form-label">Commission de
                                                                                l'agent</label>
                                                                            <input type="text" name="agent_commission"
                                                                                class="form-control" id="agent_commission"
                                                                                placeholder="Entrez la commission de l'agent"
                                                                                value="{{ $consultation->agent_commission }}">
                                                                        </div>

                                                                        <div
                                                                            class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                            <button type="button" class="btn w-sm btn-light"
                                                                                data-bs-dismiss="modal">Fermer
                                                                            </button>

                                                                            @if ($consultation->buying_price || $consultation->selling_price || $consultation->agent_commission)
                                                                                <button type="submit" class="btn btn-dark">
                                                                                    Modifier
                                                                                </button>
                                                                            @else
                                                                                <button type="submit" class="btn btn-dark">
                                                                                    Ajouter
                                                                                </button>
                                                                            @endif

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endcan
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
