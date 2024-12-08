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
                <h4 class="mb-sm-0">Expéditions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Liste des expéditions</li>
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
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th>Contact</th>
                                <th>Entreprise</th>
                                <th>Départ</th>
                                <th>Arrivée</th>
                                <th>Durée</th>
                                <th>Moyen</th>
                                <th>Quantité</th>
                                <th>Statut</th>
                                <th>Raison du retard</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shipments as $shipment)
                                <tr>
                                    <td>{{ $shipment->id }}</td>
                                    <td>{{ $shipment->customer_name }}</td>
                                    <td>{{ $shipment->company }}</td>
                                    <td>{{ $shipment->depart }}</td>
                                    <td>{{ $shipment->arrival }}</td>
                                    <td>{{ $shipment->formatted_duration }}</td>
                                    <td>{{ $shipment->medium_name }}</td>
                                    <td>{{ $shipment->quantity ?? 'N/A' }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill {{ $shipment->status === 'En transit'
                                                ? 'bg-primary'
                                                : ($shipment->status === 'Livré'
                                                    ? 'bg-success'
                                                    : ($shipment->status === 'En attente'
                                                        ? 'bg-warning'
                                                        : ($shipment->status === 'Annulé'
                                                            ? 'bg-danger'
                                                            : ''))) }} px-4 py-2">
                                            {{ $shipment->status }}
                                        </span>
                                    </td>
                                    <td>{{ $shipment->delayed_reason ?? 'N/A' }}</td>
                                    <td>
                                        @can('manage status shipments')
                                            {{-- status button --}}
                                            <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#statusModal{{ $shipment->id }}" title="Statut">
                                                <i class="ri-dice-4-line"></i>
                                            </button>

                                            {{-- status modal --}}
                                            <div id="statusModal{{ $shipment->id }}" class="modal zoomIn" tabindex="-1"
                                                aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 overflow-hidden">
                                                        <div class="modal-header p-3">
                                                            <h4 class="card-title mb-0">Modifier</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="{{ route('shipments.status', $shipment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Statut</label>
                                                                    <select name="status" class="form-select form-control-icon"
                                                                        aria-label="status">
                                                                        <option value="in_transit">En transit</option>
                                                                        <option value="delivered">Livré</option>
                                                                        <option value="pending">En attente</option>
                                                                        <option value="canceled">Annulé</option>
                                                                    </select>
                                                                </div>

                                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                    <button type="button" class="btn w-sm btn-light"
                                                                        data-bs-dismiss="modal">Fermer
                                                                    </button>

                                                                    <button type="submit" class="btn btn-success">
                                                                        Modifier
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- delayed reason button --}}
                                            <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#delayedModal{{ $shipment->id }}" title="Raison du retard">
                                                <i class="ri-hourglass-2-fill"></i>
                                            </button>

                                            {{-- delayed reason modal --}}
                                            <div id="delayedModal{{ $shipment->id }}" class="modal zoomIn" tabindex="-1"
                                                aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 overflow-hidden">
                                                        <div class="modal-header p-3">
                                                            <h4 class="card-title mb-0">Modifier</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="{{ route('shipments.delayed', $shipment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="mb-3">
                                                                    <label for="delayed_reason" class="form-label">Raison du
                                                                        retard</label>
                                                                    <input type="text" name="delayed_reason"
                                                                        class="form-control" id="delayed_reason"
                                                                        placeholder="Entrez la raison du retard"
                                                                        value="{{ $shipment->delayed_reason }}">
                                                                </div>

                                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                    <button type="button" class="btn w-sm btn-light"
                                                                        data-bs-dismiss="modal">Fermer
                                                                    </button>

                                                                    <button type="submit" class="btn btn-success">
                                                                        Modifier
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
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
