@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Rendez-vous</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('appointments.index') }}">Liste des rendez-vous</a>
                        </li>
                        <li class="breadcrumb-item active">#</li>
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
                <div class="card-header">
                    <div>
                        <a href="{{ route('appointments.index') }}"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="ri-arrow-go-back-line label-icon align-middle fs-16 me-2"></i>
                            Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date du rendez-vous</th>
                                <th>Résultat</th>
                                <th>Durée</th>
                                <th>Remarques</th>
                                <th>Lieu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr class="align-middle">
                                    <th>{{ $appointment->id }}</th>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('m/d/Y - H:m') }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $appointment->outcome === 'pending'
                                                ? 'bg-primary'
                                                : ($appointment->outcome === 'success'
                                                    ? 'bg-success'
                                                    : ($appointment->outcome === 'fail'
                                                        ? 'bg-danger'
                                                        : '')) }} px-2 py-2">
                                            {{ $appointment->outcome === 'pending' ? 'En attente' : ($appointment->outcome === 'success' ? 'Succès' : ($appointment->outcome === 'fail' ? 'Échec' : '')) }}
                                        </span>
                                    </td>
                                    <td>{{ $appointment->duration ?? 'N/A' }}</td>
                                    <td>{{ $appointment->notes ?? 'N/A' }}</td>
                                    <td>{{ $appointment->location ?? 'N/A' }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            @can('edit appointments')
                                                {{-- edit --}}
                                                <button type="button" class="btn btn-warning waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}"
                                                    title="Modifier">
                                                    <i class="ri-pencil-line"></i>
                                                </button>

                                                {{-- edit modal --}}
                                                <div id="editModal{{ $appointment->id }}" class="modal zoomIn" tabindex="-1"
                                                    aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content border-0 overflow-hidden">
                                                            <div class="modal-header p-3">
                                                                <h4 class="card-title mb-0">Modifier</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('appointments.update', $appointment->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="mb-3">
                                                                        <label for="appointment_date" class="form-label">Date du
                                                                            rendez-vous</label>
                                                                        <input type="datetime-local" name="appointment_date"
                                                                            class="form-control" id="appointment_date"
                                                                            placeholder="Entrez la date du rendez-vous"
                                                                            value="{{ $appointment->appointment_date }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="outcome"
                                                                            class="form-label">Résultat</label>
                                                                        <select name="outcome"
                                                                            class="form-select form-control-icon"
                                                                            aria-label="outcome">
                                                                            <option value="pending"
                                                                                {{ $appointment->outcome === 'pending' ? 'selected' : '' }}>
                                                                                En attente</option>
                                                                            <option value="success"
                                                                                {{ $appointment->outcome === 'success' ? 'selected' : '' }}>
                                                                                Succès</option>
                                                                            <option value="fail"
                                                                                {{ $appointment->outcome === 'fail' ? 'selected' : '' }}>
                                                                                Échec</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="duration" class="form-label">Durée</label>
                                                                        <input type="text" name="duration"
                                                                            class="form-control" id="duration"
                                                                            placeholder="Entrez la durée"
                                                                            value="{{ $appointment->duration }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="notes"
                                                                            class="form-label">Remarques</label>
                                                                        <input type="text" name="notes"
                                                                            class="form-control" id="notes"
                                                                            placeholder="Entrez les remarques"
                                                                            value="{{ $appointment->notes }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="location" class="form-label">Lieu</label>
                                                                        <input type="text" name="location"
                                                                            class="form-control" id="location"
                                                                            placeholder="Entrez le lieu"
                                                                            value="{{ $appointment->location }}">
                                                                    </div>

                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Fermer
                                                                        </button>

                                                                        <button type="submit" class="btn btn-primary">
                                                                            Modifier
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan

                                            @can('delete appointments')
                                                {{-- delete --}}
                                                <button class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal{{ $appointment->id }}"
                                                    title="Supprimer">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>

                                                {{-- delete modal --}}
                                                <div class="modal fade zoomIn" id="deleteRecordModal{{ $appointment->id }}"
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
                                                                    <form
                                                                        action="{{ route('appointments.destroy', $appointment->id) }}"
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
@endsection
