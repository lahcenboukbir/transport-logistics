@php
    $logo = DB::table('customizations')->where('name', 'logo')->first();
    $logo_sm = DB::table('customizations')->where('name', 'logo_sm')->first();
@endphp


<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('storage/' . $logo_sm->value) }}" alt="" width="100%" height="100%">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('storage/' . $logo->value) }}" alt="" width="100%" height="100%">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="{{ asset('storage/' . Auth::user()->img) }}"
                    alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">{{ Auth::user()->name }}</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text">
                        <i class="ri ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle">Online</span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>
            <a class="dropdown-item" href="{{ route('profile.show') }}">
                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Profil</span>
            </a>

            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Paramètres</span>
            </a>

            {{-- Logout button --}}
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Se déconnecter</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>

            <ul class="navbar-nav" id="navbar-nav">
                {{-- menu --}}
                <li class="menu-title">
                    <span>Menu</span>
                </li>

                {{-- dashboard --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() === 'dashboard.index' ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}">
                        <i class="ri-dashboard-line"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>

                @if (auth()->user()->can('display users') || auth()->user()->can('display customizations'))
                    {{-- users --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarUsers">
                            <i class="ri-user-line"></i>
                            <span>Utilisateurs</span>
                        </a>

                        <div class="collapse menu-dropdown
                    {{ Route::currentRouteName() === 'users.index' ||
                    Route::currentRouteName() === 'users.create' ||
                    Route::currentRouteName() === 'users.show' ||
                    Route::currentRouteName() === 'users.edit' ||
                    Route::currentRouteName() === 'roles.index' ||
                    Route::currentRouteName() === 'roles.create' ||
                    Route::currentRouteName() === 'roles.show' ||
                    Route::currentRouteName() === 'roles.edit'
                        ? 'show'
                        : '' }}"
                            id="sidebarUsers">
                            <ul class="nav nav-sm flex-column">
                                @can('display users')
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}"
                                            class="nav-link {{ Route::currentRouteName() === 'users.index' || Route::currentRouteName() === 'users.create' || Route::currentRouteName() === 'users.show' || Route::currentRouteName() === 'users.edit' ? 'active' : '' }}">
                                            Liste des utilisateurs
                                        </a>
                                    </li>
                                @endcan

                                @can('display roles')
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}"
                                            class="nav-link {{ Route::currentRouteName() === 'roles.index' || Route::currentRouteName() === 'roles.create' || Route::currentRouteName() === 'roles.show' || Route::currentRouteName() === 'roles.edit' ? 'active' : '' }}">
                                            Gestion des rôles
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif



                @can('display prospects')
                    {{-- prospects --}}
                    <li class="nav-item">
                        <a href="{{ route('prospects.index') }}"
                            class="nav-link menu-link {{ Route::currentRouteName() === 'prospects.index' || Route::currentRouteName() === 'prospects.create' || Route::currentRouteName() === 'prospects.edit' || Route::currentRouteName() === 'prospects.show' ? 'active' : '' }}">
                            <i class="ri-user-add-line"></i>
                            <span>Prospects</span>
                        </a>
                    </li>
                @endcan

                @can('display customers')
                    {{-- customers --}}
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}"
                            class="nav-link menu-link {{ Route::currentRouteName() === 'customers.index' || Route::currentRouteName() === 'customers.create' || Route::currentRouteName() === 'customers.edit' || Route::currentRouteName() === 'customers.show' ? 'active' : '' }}">
                            <i class="ri-user-follow-line"></i>
                            <span>Clients</span>
                        </a>
                    </li>
                @endcan

                @can('display appointments')
                    {{-- appointments --}}
                    <li class="nav-item">
                        <a href="{{ route('appointments.index') }}"
                            class="nav-link menu-link {{ Route::currentRouteName() === 'appointments.index' || Route::currentRouteName() === 'appointments.create' || Route::currentRouteName() === 'appointments.edit' || Route::currentRouteName() === 'appointments.show' ? 'active' : '' }}">
                            <i class="ri-calendar-2-line"></i>
                            <span>Rendez-vous</span>
                        </a>
                    </li>
                @endcan

                @can('display consultations')
                    {{-- consultations --}}
                    <li class="nav-item">
                        <a href="{{ route('consultations.index') }}"
                            class="nav-link menu-link {{ Route::currentRouteName() === 'consultations.index' || Route::currentRouteName() === 'consultations.create' || Route::currentRouteName() === 'consultations.edit' || Route::currentRouteName() === 'consultations.show' ? 'active' : '' }}">
                            <i class="ri-shake-hands-line"></i>
                            <span>Consultations</span>
                        </a>
                    </li>
                @endcan

                @can('display shipments')
                    {{-- shipments --}}
                    <li class="nav-item">
                        <a href="{{ route('shipments.index') }}"
                            class="nav-link menu-link {{ Route::currentRouteName() === 'shipments.index' ? 'active' : '' }}">
                            <i class="ri-box-3-line"></i>
                            <span>Expéditions</span>
                        </a>
                    </li>
                @endcan

                @can('display reports')
                    {{-- reports --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarUsers">
                            <i class="ri-file-chart-2-line"></i>
                            <span>Rapport</span>
                        </a>

                        <div class="collapse menu-dropdown {{ Route::currentRouteName() === 'reports.pdf' || Route::currentRouteName() === 'reports.excel' ? 'show' : '' }}"
                            id="sidebarReports">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('reports.pdf') }}"
                                        class="nav-link {{ Route::currentRouteName() === 'reports.pdf' ? 'active' : '' }}">
                                        Fichiers PDF
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('reports.excel') }}"
                                        class="nav-link {{ Route::currentRouteName() === 'reports.excel' ? 'active' : '' }}">
                                        Fichiers EXCEL
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('reports.analytics') }}"
                                        class="nav-link {{ Route::currentRouteName() === 'reports.pdf' ? 'active' : '' }}">
                                        Analytique
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @if (auth()->user()->can('display ports') || auth()->user()->can('display equipments'))
                    {{-- settings --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSettings" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarUsers">
                            <i class="ri-settings-3-line"></i>
                            <span>Paramètres</span>
                        </a>

                        <div class="collapse menu-dropdown {{ Route::currentRouteName() === 'ports.index' || Route::currentRouteName() === 'ports.create' || Route::currentRouteName() === 'ports.edit' || Route::currentRouteName() === 'equipments.index' || Route::currentRouteName() === 'equipments.edit' || Route::currentRouteName() === 'equipments.create' ? 'show' : '' }}"
                            id="sidebarSettings">
                            <ul class="nav nav-sm flex-column">
                                @can('display ports')
                                    <li class="nav-item">
                                        <a href="{{ route('ports.index') }}"
                                            class="nav-link {{ Route::currentRouteName() === 'ports.index' || Route::currentRouteName() === 'ports.create' || Route::currentRouteName() === 'ports.edit' ? 'active' : '' }}">
                                            Ports
                                        </a>
                                    </li>
                                @endcan

                                @can('display equipments')
                                    <li class="nav-item">
                                        <a href="{{ route('equipments.index') }}"
                                            class="nav-link {{ Route::currentRouteName() === 'equipments.index' || Route::currentRouteName() === 'equipments.create' || Route::currentRouteName() === 'equipments.edit' ? 'active' : '' }}">
                                            Équipements
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @can('display customizations')
                    {{-- customizations --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCustomizations" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarUsers">
                            <i class="ri-equalizer-line"></i>
                            <span>Personnalisation</span>
                        </a>

                        <div class="collapse menu-dropdown {{ Route::currentRouteName() === 'logo' || Route::currentRouteName() === 'name' ? 'show' : '' }}"
                            id="sidebarCustomizations">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('logo') }}"
                                        class="nav-link {{ Route::currentRouteName() === 'logo' ? 'active' : '' }}">
                                        LOGO
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('name') }}"
                                        class="nav-link {{ Route::currentRouteName() === 'name' ? 'active' : '' }}">
                                        NOM
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

            </ul>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
