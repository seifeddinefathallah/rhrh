<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- User Profile -->
                <li class="nav-item">
                    <img src="{{ asset('storage/' . Auth::user()->employee->image) }}" class="img-fluid">
                    <a href="{{ route('employees.show', Auth::user()->employee->id) }}" class="nav-link">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <p>{{ Auth::user()->name }}</p>
                    </a>
                </li>

                <!-- Sidebar Links -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Employees</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('requests.index') }}" class="nav-link {{ request()->routeIs('requests.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Administrative Documents</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('entites.index') }}" class="nav-link {{ request()->routeIs('entites.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Entites</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('departements.index') }}" class="nav-link {{ request()->routeIs('departements.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>Departements</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('postes.index') }}" class="nav-link {{ request()->routeIs('postes.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Postes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('authorizations.index') }}" class="nav-link {{ request()->routeIs('authorizations.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Authorizations</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('loan_requests.index') }}" class="nav-link {{ request()->routeIs('loan_requests.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Demandes Prêts et avances</p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="demandesDiversDropdown" href="#" class="nav-link dropdown-toggle {{ request()->is('demandes-divers/*') ? 'active' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nav-icon fas fa-tasks"></i>
                            <p>Demandes Divers</p>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="demandesDiversDropdown">
                        <a href="{{ route('intervention-requests.index') }}" class="dropdown-item {{ request()->routeIs('intervention-requests.index') ? 'active' : '' }}">
                                Demandes d'Interventions
                        </a>
                        <a href="{{ route('supply_requests.index') }}" class="dropdown-item {{ request()->routeIs('supply_requests.index') ? 'active' : '' }}">
                                Demandes de Fournitures
                        </a>
                        <a href="{{ route('material_requests.index') }}" class="dropdown-item {{ request()->routeIs('materiel_requests.index') ? 'active' : '' }}">
                                Demandes de Matériels Informatiques
                        </a>
                        <a href="{{ route('specific_requests.index') }}" class="dropdown-item {{ request()->routeIs('specific_requests.index') ? 'active' : '' }}">
                                Autres Demandes Spécifiques
                        </a>
                    </div>
                </li>


            </ul>
        </nav>
    </div>
</aside>
