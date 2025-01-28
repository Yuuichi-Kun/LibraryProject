@extends('layouts.user')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
      <h1 data-aos="fade-up">Jelajahi Dunia Pengetahuan di Perpustakaan Kami</h1>
      <p data-aos="fade-up" data-aos-delay="100">Temukan ribuan koleksi buku, jurnal, dan sumber daya digital untuk mendukung pembelajaran Anda</p>
      <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
        <a href="#about" class="btn-get-started">Cari Buku <i class="bi bi-search"></i></a>
        <a href="#" class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-journal-richtext"></i><span>Cara Peminjaman</span></a>
      </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
      <img src="assets/img/library-hero.jpg" class="img-fluid animated" alt="Library Hero Image">
    </div>
  </div>
</div>

</section><!-- /Hero Section -->

<!-- About Section -->
<section id="about" class="about section">

<div class="container" data-aos="fade-up">
  <div class="row gx-0">

    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
      <div class="content">
        <h3>Tentang Kami</h3>
        <h2>Perpustakaan Modern dengan Layanan Prima untuk Semua</h2>
        <p>
          Perpustakaan kami adalah pusat pembelajaran yang menyediakan akses ke berbagai sumber pengetahuan. Dengan koleksi yang terus diperbarui dan fasilitas modern, kami berkomitmen untuk mendukung kebutuhan literasi dan edukasi masyarakat.
        </p>
        <div class="text-center text-lg-start">
          <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
            <span>Selengkapnya</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
      <img src="assets/img/library-about.jpg" class="img-fluid" alt="Library Interior">
    </div>

  </div>
</div>

</section><!-- /About Section -->

<!-- Values Section (Latest Books) -->
<section id="values" class="values section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Buku Terbaru</h2>
        <p>Koleksi Terbaru Perpustakaan Kami</p>
    </div>

    <div class="container">
        <div class="row gy-4">
            @forelse($latestBooks as $book)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration }}00">
                    <div class="card">
                        <a href="{{ route('book.show', $book->id_pustaka) }}" class="text-decoration-none">
                            @if($book->gambar)
                                <img src="{{ asset($book->gambar) }}" class="img-fluid" alt="{{ $book->judul_pustaka }}">
                            @else
                                <img src="{{ asset('assets/img/default-book.png') }}" class="img-fluid" alt="Default Book Image">
                            @endif
                            <h3>{{ $book->judul_pustaka }}</h3>
                            <p>
                                <strong>Pengarang:</strong> {{ $book->pengarang->nama_pengarang ?? 'Tidak ada data' }}<br>
                                <strong>Penerbit:</strong> {{ $book->penerbit->nama_penerbit ?? 'Tidak ada data' }}<br>
                                <strong>Tahun:</strong> {{ $book->tahun_terbit }}
                            </p>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada buku terbaru.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection