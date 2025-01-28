<Section class="navbar">
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/logo.png') }}" alt="">
        <h1 class="sitename">LibraryProject</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home') }}" class="active">Home<br></a></li>
          <li><a href="{{ route('anggota.create') }}">Daftar Anggota</a></li>
          <li><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
          <li><a href="{{ route('books.index') }}">Katalog Buku</a></li>

          @auth
            <li class="nav-item dropdown no-arrow ml-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-none d-lg-inline text-dark fw-medium">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->avatar)
                        <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
                    @else
                        <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-sm animated--grow-in py-2" 
                     style="min-width: 200px; margin-top: 0.5rem;"
                     aria-labelledby="userDropdown">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 hover-bg-light" 
                       href="{{ route('profileUser.edit') }}">
                        <i class="fas fa-user fa-sm fa-fw text-gray-500"></i>
                        <span>Profile</span>
                    </a>
                    <div class="dropdown-divider my-2"></div>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 hover-bg-light" 
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-500"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
          @else
            <li class="nav-item ml-3">
                <a href="{{ route('login') }}" 
                   class="btn btn-primary rounded-pill px-4 py-2 fw-medium">
                   Login
                </a>
            </li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>
</Section>