<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
      data-assets-path="../backend/assets/"
      data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <title>Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../backend/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('../backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('../backend/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('../backend/assets/js/config.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .container-expanded {
            margin-left: 50px; /* Adjust as needed */
            transition: margin-left 0.3s ease;
            color: #03428e;
        }
        .container-collapsed {
            margin-left: 80px; /* Adjust as needed */
            transition: margin-left 0.3s ease;
        }
        .layout-menu-toggle {
            cursor: pointer;
            color: #03428e;
        }
    </style>
</head>
<body>
    <nav x-data="{ open: true }" :class="{ 'container-expanded': open, 'container-collapsed': !open }" class="bg-gray-50 border-b border-gray-500">
        <div class="layout-wrapper layout-content-navbar d-flex">
            <div class="layout-container container d-flex" >

          <!-- Menu -->

          <aside x-show="open"  id="layout-menu" class="layout-menu  menu-vertical menu bg-menu-theme " class="navbar-dark d-flex":class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden"  >

            <div class="app-brand demo">

                <a href="{{ request()->is('dashboard') }}" class="app-brand-link gap-2">
                    <img src="{{ asset('../backend/image-removebg-preview.png') }}" alt="CSI Maghreb Logo" width="130" class="center-logo" />


                </a>

                    <defs>
                      <path
                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                        id="path-1"
                      ></path>
                      <path
                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                        id="path-3"
                      ></path>
                      <path
                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                        id="path-4"
                      ></path>
                      <path
                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                        id="path-5"
                      ></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                          <g id="Mask" transform="translate(0.000000, 8.000000)">
                            <mask id="mask-2" fill="white">
                              <use xlink:href="#path-1"></use>
                            </mask>
                            <use fill="#696cff" xlink:href="#path-1"></use>
                            <g id="Path-3" mask="url(#mask-2)">
                              <use fill="#696cff" xlink:href="#path-3"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                            </g>
                            <g id="Path-4" mask="url(#mask-2)">
                              <use fill="#696cff" xlink:href="#path-4"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                            </g>
                          </g>
                          <g
                            id="Triangle"
                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                          >
                            <use fill="#696cff" xlink:href="#path-5"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </span>

              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link  ms-auto d-block  toggle-navbar">
                <i class="bx bx-chevron-left bx-sm align-middle" @click="open = !open" ></i>

            </a>

            </div>



            <ul class="menu-inner py-1">
                <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle "></i>
                        <div data-i18n="Analytics"  >Dashboard</div>
                    </a>
                </li>

                <!-- Layouts -->
                <li class="menu-item {{ request()->is('employees') ? 'active' : '' }}">
                    <a  href="{{ route('employees.index') }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Layouts"  >Employees</div>
                    </a>



                  <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('employees') ? 'active' : '' }}">
                        <a href="{{ route('employees.index') }}" class="menu-link">
                            <div data-i18n="Without menu">List Employees</div>
                        </a>
                    </li>
                </ul>

                </li>

                <li class="menu-header small text-uppercase">
                  <span class="menu-header-text" style="display: block; text-align: center;">Entites            & Departements & Postes</span>
              </li>
              <li class="menu-item {{ request()->is('departements') || request()->is('departements/create') || request()->is('postes') || request()->is('postes/create') || request()->is('entites') || request()->is('entites/create') ? 'active' : '' }}">
                  <a href="#" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-dock-top" ></i>
                      <div data-i18n="Account Settings" style="display: block; ">Entites & Departements & Postes</div>
                  </a>
                  <ul class="menu-sub">
                      <li class="menu-item {{ request()->is('entites') || request()->is('entites/create') ? 'active' : '' }}">
                          <a href="#" class="menu-link1 menu-toggle">
                              <i class="menu-icon tf-icons bx bx-cube-alt"style="margin-left: 45px;transform: translateY(25px);"></i>
                              <div style="display: block; text-align: center;">Entites</div>
                          </a>
                          <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('entites') ? 'active' : '' }}">
                              <a href="{{ route('entites.index') }}" class="menu-link">
                                  <div data-i18n="Connections">List entites</div>
                              </a>
                          </li>
                              <li class="menu-item {{ request()->is('entites/create') ? 'active' : '' }}">
                                  <a href="{{ route('entites.create') }}" class="menu-link">
                                      <div data-i18n="Error">Create Entites</div>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="menu-item {{ request()->is('departements') || request()->is('departements/create') ? 'active' : '' }}">
                          <a href="#" class="menu-link1 menu-toggle">
                            <i class="menu-icon tf-icons bx bx-home-circle" style="margin-left: 45px;transform: translateY(25px); color: #00b5cc;"></i>


                              <div data-i18n="Account Settings" style="display: block; text-align: center;">Departements</div>
                          </a>
                          <ul class="menu-sub">
                              <li class="menu-item {{ request()->is('departements') ? 'active' : '' }}">
                                  <a href="{{ route('departements.index') }}" class="menu-link">
                                      <div data-i18n="Notifications">List Departements</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->is('departements/create') ? 'active' : '' }}">
                                  <a href="{{ route('departements.create') }}" class="menu-link">
                                      <div data-i18n="Error">Create Departements</div>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="menu-item {{ request()->is('postes') || request()->is('postes/create') ? 'active' : '' }}">
                          <a href="#" class="menu-link1 menu-toggle">
                              <i class="menu-icon tf-icons bx bx-box"style="margin-left: 45px;transform: translateY(25px);"></i>
                              <div data-i18n="Account Settings" style="display: block; text-align: center;">Postes</div>
                          </a>
                          <ul class="menu-sub">
                              <li class="menu-item {{ request()->is('postes') ? 'active' : '' }}">
                                  <a href="{{ route('postes.index') }}" class="menu-link">
                                      <div data-i18n="Connections">List Postes</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->is('postes/create') ? 'active' : '' }}">
                                  <a href="{{ route('requests.create') }}" class="menu-link">
                                      <div data-i18n="Error">Create Postes</div>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  </ul>
              </li>



              <li class="menu-header small text-uppercase">
                <span class="menu-header-text" style="display: block; text-align: center;">Documents
                   </span>
              </li>
              <li class="menu-item {{ request()->is('requests') ? 'active' : ''}}">
                <a href="" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-detail"></i>
                  <div data-i18n="Authentications" >Documents</div>
                </a>

              <ul class="menu-sub">
                  <li class="menu-item {{ request()->is('requests') ? 'active' : ''}}">
                    <a href="{{ route('requests.index') }}" class="menu-link" target="_blank">
                      <div data-i18n="Basic">Administrative Documents</div>
                    </a>
                  </li>

                </ul>


              <!-- Authorizations -->
              <li class="menu-header small text-uppercase"><span class="menu-header-text" style="display: block; text-align: center;">Authorizations
            </span></li>
              <!-- Authorizations-->
              <li class="menu-item {{ request()->is('authorizations') ? 'active' : ''}}">
                <a href="{{ route('authorizations.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-collection"></i>
                  <div data-i18n="Basic">Authorizations
                </div>
                </a>
              </li>

              <li class="menu-header small text-uppercase">
                <span class="menu-header-text" style="display: block; text-align: center;">Mes demandes </span>
              </li>
              <li class="menu-item {{ request()->is('loan_requests') ? 'active' : ''}}">
                <a href="{{ route('loan_requests.index') }}" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-collection"style="color: white;"></i>
                  <div data-i18n="Boxicons" style="display: block; text-align: center;">Mes demandes</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item {{ request()->is('loan_requests') ? 'active' : ''}}">
                    <a href="{{ route('loan_requests.index') }}" class="menu-link" >
                      <div data-i18n="Error">Demandes Prêt Avances </div>
                    </a>
                  </li>

                </ul>
             <!-- </li>

               Forms & Tables &amp;-->
               <li class="menu-header small text-uppercase">
                <span class="menu-header-text" style="display: block; text-align: center;">Types Contrats</span>
              </li>
              <!-- Forms -->
              <li class="menu-item {{ request()->is('contract-types') ? 'active' : ''}}">
                <a href="{{ route('contract-types.index') }}" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-credit-card"style="color: white;"></i>
                  <div data-i18n="Boxicons"style="color: white;">Types Contrats</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{ request()->is('contract-types') ? 'active' : ''}}">
                    <a href="{{ route('contract-types.index') }}" class="menu-link" >
                      <div data-i18n="Error">List Type Contrat </div>
                    </a>
                  </li>

                  <li class="menu-item {{ request()->is('contract-types/create') ? 'active' : ''}}">
                    <a href="{{ route('contract-types.create') }}" class="menu-link" >
                      <div data-i18n="Error">Create Type Contrat </div>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="menu-header small text-uppercase">
                <span class="menu-header-text" style="display: block; text-align: center;">Demandes Divers</span>
            </li>
            <li class="menu-item {{ request()->is('intervention-requests/*') || request()->is('supply_requests/*') || request()->is('material_requests/*') || request()->is('specific_requests/*') ? 'active' : '' }}">
                <a href="#" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-show-alt "style="color: white;"></i>
                    <div data-i18n="Boxicons"style="color: white;">Demandes Divers</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('intervention-requests.index') ? 'active' : '' }}">
                        <a href="{{ route('intervention-requests.index') }}" class="menu-link">
                            <div data-i18n="Intervention Requests" style="display: block; text-align: center;">Demandes d'Interventions</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('supply_requests.index') ? 'active' : '' }}">
                        <a href="{{ route('supply_requests.index') }}" class="menu-link">
                            <div data-i18n="Supply Requests" style="display: block; text-align: center;">Demandes de Fournitures</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('material_requests.index') ? 'active' : '' }}">
                        <a href="{{ route('material_requests.index') }}" class="menu-link">
                            <div data-i18n="Material Requests" style="display: block; text-align: center;">Demandes de Matériels Informatiques</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('specific_requests.index') ? 'active' : '' }}">
                        <a href="{{ route('specific_requests.index') }}" class="menu-link">
                            <div data-i18n="Specific Requests" style="display: block; text-align: center;">Autres Demandes Spécifiques</div>
                        </a>
                    </li>
                </ul>
            </li>


          </aside>

          <!-- / Menu -->

          <!-- Layout container -->
          <div class="layout-page">
            <!-- Navbar -->

           <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme ms-auto"
            id="layout-navbar"
          >
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0" data-testid="menu-hamburger">
            <a @click="open = !open" class="nav-item nav-link px-0 me-xl-4 toggle-sidebar-btn">
                <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>


          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                  type="text"
                  class="form-control border-0 shadow-none"
                  placeholder="Search..."
                  aria-label="Search..."
                />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->
              <li class="nav-item lh-1 me-3">
                <a
                  class="github-button"
                  href="https://github.com/themeselection/sneat-html-admin-template-free"
                  data-icon="octicon-star"
                  data-size="large"
                  data-show-count="true"
                  aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                  >Star</a
                >
              </li>

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <div lass="flex-grow-1">{{ Auth::user()->name }}</div>
                          <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('employees.show', Auth::user()->employee->id) }}">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                        <ul class="dropdown-submenu">
                            <li>
                                <a class="dropdown-item" href="#" id="toggle-full-display">
                                    <i class="bx bx-fullscreen me-2"></i>
                                    <span class="align-middle">Full Display</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bx bx-globe me-2"></i>
                                    <span class="align-middle">Translation</span>
                                </a>
                                <ul class="dropdown-submenu">
                                    <li>
                                        <a class="dropdown-item" href="?lang=en">English</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="?lang=fr">French</a>
                                    </li>
                                    <!-- Add more languages as needed -->
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                        <span class="flex-grow-1 align-middle">Billing</span>
                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>
                    </ul>
                  </li>
                  <!--/ User -->
                </ul>
              </div>
            </nav>

            <!-- / Navbar -->
    <!-- Responsive Navigation Menu -->
    <!--
      <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.index')">
                {{ __('Employees') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('requests.index')" :active="request()->routeIs('requests.index')">
                {{ __('Administrative Documents') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('entites.index')" :active="request()->routeIs('entites.index')">
                {{ __('Entites') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('departements.index')" :active="request()->routeIs('departements.index')">
                {{ __('Departements') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('postes.index')" :active="request()->routeIs('postes.index')">
                {{ __('Postes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('authorizations.index')" :active="request()->routeIs('authorizations.index')">
                {{ __('Authorizations') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('loan_requests.index')" :active="request()->routeIs('loan_requests.index')">
                {{ __('Mes demandes') }}
            </x-responsive-nav-link>
        </div>



    </div>-->
</nav>

    <!-- Core JS -->
    <script src="{{ asset('../backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/js/menu.js') }}"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('../backend/assets/js/main.js') }}"></script>

    <!-- OneSignal SDK -->
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.js" defer></script>
    <script>
      document.addEventListener('alpine:init', () => {
          Alpine.data('menu', () => ({
              open: false
          }));
      });
  </script>
    <script>

        document.getElementById('toggle-full-display').addEventListener('click', function () {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });

        // Add more script logic for translations if needed
    </script>

    <style>


        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        .dropdown-submenu > a:after {
            content: "»";
            float: right;
            margin-left: 5px;
        }
    </style>
</body>
</html>
