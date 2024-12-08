@extends('layouts.app')

@section('link')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
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
                    <img src="{{ asset('storage/' . $user->img) }}" alt="user-img" class="img-thumbnail rounded-circle"
                        style="height: 100%; width:100%;object-fit:cover;" />
                </div>
            </div>

            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $user->name }}</h3>
                    <p class="text-white text-opacity-75 text-capitalize">{{$role->name}}</p>
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
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#prospects-tab" role="tab">
                                <i class="ri-user-add-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Prospects</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#customers-tab" role="tab">
                                <i class="ri-user-follow-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Clients</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#appointments-tab" role="tab">
                                <i class="ri-calendar-2-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Rendez-vous</span>
                            </a>
                        </li>
                    </ul>

                    <div class="flex-shrink-0">
                        <a href="{{route('profile.edit')}}" class="btn btn-success">
                            <i class="ri-edit-box-line align-bottom"></i> Modifier le profil
                        </a>
                    </div>

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
                                                        <td class="text-muted">{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Email :</th>
                                                        <td class="text-muted">{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Numéro de téléphone :</th>
                                                        <td class="text-muted">{{ $user->phone_number ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Addresse :</th>
                                                        <td class="text-muted">{{ $user->address ?? 'N/A' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date d'entrée</th>
                                                        <td class="text-muted">{{ $user->created_at }}</td>
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

                    <div class="tab-pane" id="prospects-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Contact</th>
                                            <th>Entreprise</th>
                                            <th>Numéro de téléphone</th>
                                            <th>Statut</th>
                                            <th>Prochain rendez-vous</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($prospects as $prospect)
                                            <tr class="align-middle">
                                                <th>{{ $prospect->id }}</th>
                                                <td>{{ $prospect->name }}</td>
                                                <td>{{ $prospect->company }}</td>
                                                <td>{{ $prospect->phone_number ?? 'N/A' }}</td>
                                                <td>{{ $prospect->status }}</td>
                                                <td>{{ $prospect->next_followup_date }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Il n'y a aucun prospect ajouté par
                                                    {{ $user->name }}.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="customers-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Contact</th>
                                            <th>Entreprise</th>
                                            <th>Numéro de téléphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customers as $customer)
                                            <tr class="align-middle">
                                                <th>{{ $customer->id }}</th>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->company }}</td>
                                                <td>{{ $customer->phone_number ?? 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Il n'y a aucun client ajouté par
                                                    {{ $user->name }}.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
                                            <th>Contact</th>
                                            <th>Entreprise</th>
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
                                                <td>{{ $appointment->name }}</td>
                                                <td>{{ $appointment->company }}</td>
                                                <td>{{ $appointment->appointment_date }}</td>
                                                <td>{{ $appointment->outcome }}</td>
                                                <td>{{ $appointment->duration ?? 'N/A' }}</td>
                                                <td>{{ $appointment->notes ?? 'N/A' }}</td>
                                                <td>{{ $appointment->location ?? 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Il n'y a aucun rendez-vous ajouté
                                                    par
                                                    {{ $user->name }}.</td>
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
