<nav :class="{ 'container-expanded': open, 'container-collapsed': !open }" class=" layout-navbar container-collapsed navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme ms-auto">

    
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0" data-testid="menu-hamburger">
<a @click="open = !open" class="nav-item nav-link px-0 me-xl-4 toggle-sidebar-btn">
    <i class="bx bx-menu bx-sm"></i>
</a>
</div>



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

<ul class="navbar-nav ml-auto flex-row align-items-center ms-auto">
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
        <img src="{{ asset('storage/' . Auth::user()->employee->image) }}"  />
      </div>
    </a>
    
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="#">
          <div class="d-flex">
            <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online">
                <img src="{{ asset('storage/' . Auth::user()->employee->image) }}" />
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
        <a class="dropdown-item" href="#">
          <i class="bx bx-user me-2"></i>
          <span class="align-middle">My Profile</span>
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="#">
          <i class="bx bx-cog me-2"></i>
          <span class="align-middle">Settings</span>
        </a>
      </li>
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
