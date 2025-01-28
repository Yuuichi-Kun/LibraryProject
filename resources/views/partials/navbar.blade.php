<section class="navbar">
    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="{{ route('admin.home') }}" class="logo d-flex align-items-center">
    <img src="{{ asset('assets/img/logo.png') }}" alt="">
    <span class="d-none d-lg-block">LibraryProject</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">
    <li class="nav-item dropdown pe-3">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" 
         href="#" 
         data-bs-toggle="dropdown" 
         aria-expanded="false"
         role="button">
         @if(Auth::user()->avatar)
                <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
            @else
                <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
            @endif
        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
      </a>

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{ Auth::user()->name }}</h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ Auth::user()->type == 'admin' ? route('admin.profile.edit') : route('profileUser.edit') }}">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#" 
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>{{ __('Logout') }}</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </li>
  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
</section>