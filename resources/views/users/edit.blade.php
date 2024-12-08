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
                        <li class="breadcrumb-item">
                            <a href="#">Accueil</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.index') }}">Liste des utilisateurs</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="text" name="name" class="form-control form-control-icon"
                                                id="name" placeholder="Entrez le nom" value={{ $user->name }}
                                                required>
                                            <i class="ri-user-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <input type="email" name="email" class="form-control form-control-icon"
                                                id="email" placeholder="Entrez l'email" value={{ $user->email }}
                                                required>
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <div class="form-icon">
                                            <input type="password" name="password" class="form-control form-control-icon"
                                                id="password" placeholder="Entrez le mot de passe">
                                            <i class="ri-lock-password-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                        <div class="form-icon">
                                            <input type="text" name="phone_number" class="form-control form-control-icon"
                                                id="phone_number" placeholder="Entrez le numéro de téléphone"
                                                value={{ $user->phone_number }}>
                                            <i class="ri-phone-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse</label>
                                        <div class="form-icon">
                                            <input type="text" name="address" class="form-control form-control-icon"
                                                id="address" placeholder="Entrez l'adresse" value={{ $user->address }}>
                                            <i class="ri-home-3-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Rôle <span
                                                class="text-danger">*</span></label>
                                        <div class="form-icon">
                                            <select name="role_id" class="form-select form-control-icon"
                                                aria-label="role_id">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role->id === $assigned_role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="ri-user-settings-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Image</label>
                                        <input class="form-control" type="file" name="img" id="img"
                                            value={{ Storage::url($user->img) }}>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="text-start">

                                        <a href="{{ route('users.index') }}"
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
