@extends('layouts.app')

@section('link')
@endsection

@section('content')
    @if (session('success'))
        <div class="bg-light" aria-live="polite" aria-atomic="true" style="position: relative; z-index:999">
            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast"
                style="position: absolute; top: 16px; right: 16px;">
                <div class="toast-header">
                    <i class="ri-notification-off-line label-icon me-2 "></i>
                    <span class="fw-semibold me-auto ">Success</span>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-light" aria-live="polite" aria-atomic="true" style="position: relative; z-index:999">
            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast"
                style="position: absolute; top: 16px; right: 16px;">
                <div class="toast-header">
                    <i class="ri-notification-off-line label-icon me-2 "></i>
                    <span class="fw-semibold me-auto ">Error</span>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            {{-- profile --}}
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ asset('storage/' . $user->img) }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                alt="user-profile-image">
                        </div>
                        <h5 class="fs-16 mb-1">{{ $user->name }}</h5>
                        <p class="text-muted mb-0 text-capitalize">{{$role->name}}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        {{-- personal details --}}
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> Détails personnels
                            </a>
                        </li>

                        {{-- change password --}}
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> Changer le mot de passe
                            </a>
                        </li>

                        {{-- delete account --}}
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#deleteAccount" role="tab">
                                <i class="far fa-envelope"></i> Supprimer le compte
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content">

                        {{-- personal details --}}
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('profile.details') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Entrez votre nom" value="{{ $user->name }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Entrez votre e-mail" value="{{ $user->email }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                id="phone_number" placeholder="Entrez votre numéro de téléphone"
                                                value="{{ $user->phone_number }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="img" class="form-label">Image</label>
                                            <input class="form-control" type="file" name="img" id="img"
                                                value={{ asset('storage/' . $user->img) }}>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="address" class="form-label">Adresse</label>
                                            <textarea class="form-control" name="address" id="address" placeholder="Entrez votre adresse" rows="2">{{ $user->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-success">Mettre à jour</button>
                                            {{-- <a href="{{ route('dashboard.index') }}"
                                                class="btn btn-soft-success">Annuler</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- change password --}}
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('profile.password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="old-password" class="form-label">Ancien mot de passe <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="old-password" class="form-control"
                                                id="old-password" placeholder="Entrez le mot de passe actuel" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div>
                                            <label for="new-password" class="form-label">Nouveau mot de passe <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="new-password" class="form-control"
                                                id="new-password" placeholder="Entrez le nouveau mot de passe" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirm-password" class="form-label">Confirmer le mot de passe
                                                <span class="text-danger">*</span></label>
                                            <input type="password" name="confirm-password" class="form-control"
                                                id="confirm-password" placeholder="Confirmez le mot de passe" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Changer le mot de
                                                passe</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>

                        {{-- delete account --}}
                        <div class="tab-pane" id="deleteAccount" role="tabpanel">
                            <form action="{{ route('profile.destroy') }}" method="post">
                                @csrf
                                @method('DELETE')

                                <div>
                                    <h5 class="card-title text-decoration-underline mb-3">Supprimer ce compte:</h5>

                                    <div>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Entrez votre mot de passe" style="max-width: 265px;" required>
                                    </div>

                                    <div class="hstack gap-2 mt-3">
                                        <button type="submit" class="btn btn-danger">
                                            Fermer et supprimer ce compte
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- notifications init -->
    <script src="{{ asset('assets/js/pages/notifications.init.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
@endsection
