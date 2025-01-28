<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('partials.navbar')

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('rak.index') }}">
          <i class="bi bi-bookshelf"></i>
          <span>Manajemen Rak</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('ddc.index') }}">
          <i class="bi bi-journal-text"></i>
          <span>Manajemen DDC</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('format.index') }}">
          <i class="bi bi-file-text"></i>
          <span>Manajemen Format</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('penerbit.index') }}">
          <i class="bi bi-building"></i>
          <span>Manajemen Penerbit</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pengarang.index') }}">
          <i class="bi bi-person"></i>
          <span>Manajemen Pengarang</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('jenis-anggota.index') }}">
          <i class="bi bi-people"></i>
          <span>Manajemen Jenis Anggota</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('perpustakaan.edit') }}">
          <i class="bi bi-building"></i>
          <span>Profil Perpustakaan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pustaka.index') }}">
          <i class="bi bi-book"></i>
          <span>Manajemen Pustaka</span>
        </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.anggota.index') }}">
              <i class="bi bi-people"></i>
              <span>Manajemen Anggota</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.transaksi.index') }}">
              <i class="bi bi-journal-text"></i>
              <span>Manajemen Transaksi</span>
          </a>
      </li>

    </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

    @yield('content')

    </main><!-- End #main -->

  @include('partials.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>