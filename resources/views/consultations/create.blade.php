@extends('layouts.app')

@section('link')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Consultations</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('consultations.index') }}">Liste des consultations</a>
                        </li>
                        <li class="breadcrumb-item active">Créer un consultations</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <div>
                        <form action="{{ route('consultations.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">Contact <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="customer_id" class="form-select form-control-icon"
                                                aria-label="customer_id" required>
                                                <option disabled selected>Sélectionnez un statut</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="ri-user-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="consultation_date" class="form-label">Date de consultation <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="datetime-local" name="consultation_date"
                                                class="form-control form-control-icon" id="consultation_date" required>
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="departure_port_id" class="form-label">Port de départ <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="departure_port_id" class="form-select form-control-icon"
                                                aria-label="departure_port_id" required>
                                                <option disabled selected>Sélectionnez un statut</option>
                                                @foreach ($ports as $port)
                                                    <option value="{{ $port->id }}">{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="ri-ship-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="arrival_port_id" class="form-label">Port d'arrivée <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="arrival_port_id" class="form-select form-control-icon"
                                                aria-label="arrival_port_id" required>
                                                <option disabled selected>Sélectionnez un statut</option>
                                                @foreach ($ports as $port)
                                                    <option value="{{ $port->id }}">{{ $port->port_name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="ri-ship-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="departure_date" class="form-label">Date de départ</label>
                                        <div class="form-icon">
                                            <input type="datetime-local" name="departure_date"
                                                class="form-control form-control-icon" id="departure_date">
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="arrival_date" class="form-label">Date d'arrivée</label>
                                        <div class="form-icon">
                                            <input type="datetime-local" name="arrival_date"
                                                class="form-control form-control-icon" id="arrival_date">
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantité</label>
                                        <div class="form-icon">
                                            <input type="number" name="quantity" class="form-control form-control-icon"
                                                id="quantity" placeholder="Entrez la quantité">
                                            <i class="ri-funds-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="medium_name" class="form-label">Moyen <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="medium_name" class="form-select form-control-icon"
                                                aria-label="medium_name" id="medium_name">
                                                <option disabled selected>Sélectionnez un moyen</option>
                                                <option value="air">Aérien</option>
                                                <option value="maritime">Maritime</option>
                                                <option value="road">Routier</option>
                                            </select>
                                            <i class="ri-route-line"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- air equipment --}}
                                <div class="col-md-6" id="volume-field" style="display: none;">
                                    <div class="mb-3">
                                        <label for="volume" class="form-label">Volume <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="number" name="volume" class="form-control form-control-icon"
                                                id="volume" placeholder="Entrez le volume">
                                            <i class="ri-funds-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" id="weight-field" style="display: none;">
                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Poids <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="number" name="weight" class="form-control form-control-icon"
                                                id="weight" placeholder="Entrez le poids">
                                            <i class="ri-funds-line"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- maritime equipment --}}
                                <div class="col-md-6" id="maritime-field" style="display: none;">
                                    <div class="mb-3">
                                        <label for="maritime_equipment_id" class="form-label">Type d'équipement
                                            <span class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="maritime_equipment_id" class="form-select form-control-icon"
                                                aria-label="maritime_equipment_id" id="maritime_equipment_id">
                                                <option disabled selected>Sélectionnez le type d'équipement</option>
                                                @foreach ($maritime_equipments as $maritime_equipment)
                                                    <option value="{{ $maritime_equipment->id }}">
                                                        {{ $maritime_equipment->equipment_name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="ri-ship-2-line"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- road equipment --}}
                                <div class="col-md-6" id="road-field" style="display: none;">
                                    <div class="mb-3">
                                        <label for="road_equipment_id" class="form-label">Type d'équipement
                                            <span class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="road_equipment_id" class="form-select form-control-icon"
                                                aria-label="road_equipment_id" id="road_equipment_id">
                                                <option disabled selected>Sélectionnez le type d'équipement</option>
                                                @foreach ($road_equipments as $road_equipment)
                                                    <option value="{{ $road_equipment->id }}">
                                                        {{ $road_equipment->equipment_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="ri-truck-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-start">

                                        <a href="{{ route('consultations.index') }}"
                                            class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="ri-arrow-go-back-line label-icon align-middle fs-16 me-2"></i>
                                            Retour
                                        </a>

                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                            Ajouter
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
    <script>
        $(document).ready(function() {
            $('#medium_name').change(function() {
                $('#volume-field, #weight-field, #maritime-field, #road-field').hide();

                $('#volume, #weight, #maritime_equipment_id, #road_equipment_id').prop('required', false);

                var selected_medium = $(this).val();

                if (selected_medium === 'air') {
                    $('#volume-field').show();
                    $('#weight-field').show();
                    $('#volume').prop('required', true);
                    $('#weight').prop('required', true);
                } else if (selected_medium === 'maritime') {
                    $('#maritime-field').show();
                    $('#maritime_equipment_id').prop('required', true);
                } else if (selected_medium === 'road') {
                    $('#road-field').show();
                    $('#road_equipment_id').prop('required', true);
                }
            });
        });
    </script>
@endsection
